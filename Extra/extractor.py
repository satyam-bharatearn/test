import fitz  # PyMuPDF
import sys
import json
import re
import pdfplumber
import camelot

def extract_personal_details(text):
    details = {}

    name_match = re.search(r'(?i)\bName\s*[:\-]?\s*([A-Z \.]+)', text)
    if name_match:
        details['name'] = name_match.group(1).title()

    father_match = re.search(r'(?i)(S/O|D\.O|W/O)\s*([A-Z ]+)', text)
    if father_match:
        details['father_name'] = father_match.group(0).upper()

    address_match = re.search(r'(?i)(Address\s*[:\-]?\s*)(.+?)(?=City|Pin|State|Phone|Branch|Email|Customer)', text, re.DOTALL)
    if address_match:
        address = address_match.group(2).replace('\n', ' ').strip()
        details['address'] = re.sub(r'\s+', ' ', address)

    phone_match = re.search(r'\b[6-9]\d{9}\b', text)
    if phone_match:
        details['phone'] = phone_match.group()

    cust_match = re.search(r'(?i)(Customer ID|CIF ID)\s*[:\-]?\s*(\d+)', text)
    if cust_match:
        details['customer_id'] = cust_match.group(2)

    acc_match = re.search(r'(?i)Account Number\s*[:\-]?\s*([0-9Xx]{9,20})', text)
    if acc_match:
        details['account_no'] = acc_match.group(1)

    # IFSC
    ifsc_match = re.search(r'\b[A-Z]{4}0[A-Z0-9]{6}\b', text)
    if ifsc_match:
        details['ifsc'] = ifsc_match.group()

    # Branch
    branch_match = re.search(r'(?i)Branch\s*Name\s*[:\-]?\s*([A-Z &]+)', text)
    if branch_match:
        details['branch_name'] = branch_match.group(1).title()

    # Statement date range
    date_range = re.search(r'(?i)(from\s*[:\-]?\s*)(\d{2}[\/\-]\d{2}[\/\-]\d{4}).*?(to\s*[:\-]?\s*)(\d{2}[\/\-]\d{2}[\/\-]\d{4})', text)
    if date_range:
        details['from_date'] = date_range.group(2)
        details['to_date'] = date_range.group(4)

    return details    

def extract_transactions(text):
    lines = [line.strip() for line in text.split('\n') if line.strip()]
    transactions = []

    txn_start = False
    headers_detected = False
    for i, line in enumerate(lines):
        if not headers_detected and re.search(r'(?i)(Date.*Description.*Debit.*Credit.*Balance|Date.*Particulars.*Withdrawals.*Deposits.*Balance)', line):
            headers_detected = True
            txn_start = True
            continue

        if txn_start:
            match = re.match(
                r'(\d{2}[\/\-]\d{2}[\/\-]\d{4})\s+(.{5,80}?)\s+((\d{1,3}(?:,\d{3})*|\d+)\.\d{2})?\s*((\d{1,3}(?:,\d{3})*|\d+)\.\d{2})?\s*((\d{1,3}(?:,\d{3})*|\d+)\.\d{2})?', 
                line
            )
            if match:
                date = match.group(1)
                desc = match.group(2).strip()
                debit = match.group(3)
                credit = match.group(5)
                balance = match.group(7)

                txn_type = None
                amount = None

                if credit and not debit:
                    txn_type = "deposit"
                    amount = credit
                elif debit:
                    txn_type = "withdrawal"
                    amount = debit

                transactions.append({
                    'date': date,
                    'description': desc,
                    'amount': amount.replace(",", "") if amount else None,
                    'balance': balance.replace(",", "") if balance else None,
                    'type': txn_type
                })

    return transactions


def extract_content_from_pdf(file_path, password=None):
    try:
        doc = fitz.open(file_path)
        if doc.needs_pass:
            if not password:
                print(json.dumps({'error': 'Password required'}))
                return
            if not doc.authenticate(password):
                print(json.dumps({'error': 'Invalid Password'}))
                return
        data = {'personal_details': {}, 'transactions': []}
        transactions = []
        with pdfplumber.open(file_path,password=password) as pdf:
            text = pdf.pages[0].extract_text()
            if text:
                name_match = re.search(r'(?i)Name\s*[:\(cid:9\)\-]*\s*([A-Z0-9 \.\-&]+)', text, re.IGNORECASE)
                name = name_match.group(1).strip() if name_match else None
                corp_addr_match = re.search(r'(?i)(Address\s*[:\-]?\s*)(.+?)(?=City|Pin|State|Phone|Branch|Email|Customer)', text, re.IGNORECASE | re.DOTALL)
                bank_address = corp_addr_match.group(1).replace('\n', ' ').strip() if corp_addr_match else None
                acc_match = re.search(r'Account\s*Number\s*[:\(cid:9\)\-]*\s*([0-9Xx]{9,20})', text, re.IGNORECASE)
                account_number = acc_match.group(1).strip() if acc_match else None
                ifsc_match = re.search(r'IFS\s*Code\s*[:\(cid:9\)\-]*\s*([A-Z]{4}0[A-Z0-9]{6})', text, re.IGNORECASE)
                ifsc_code = ifsc_match.group(1).strip() if ifsc_match else None
                period_match = re.search(r'Account Statement from\s*([0-9]{1,2}\s+\w+\s+[0-9]{4})\s*to\s*([0-9]{1,2}\s+\w+\s+[0-9]{4})', text, re.IGNORECASE)
                father_match = re.search(r'(?i)(S/O|D\.O|W/O)\s*([A-Z ]+)', text)
                father_name = father_match.group(0).upper() if father_match else None
                phone_match = re.search(r'\b[6-9]\d{9}\b', text)
                phone = phone_match.group() if phone_match else None
                cust_match = re.search(r'(?i)(Customer ID|CIF ID)\s*[:\-]?\s*(\d+)', text)
                customer_id = cust_match.group(2) if cust_match else None
                branch_match = re.search(r'(?i)Branch\s*Name\s*[:\-]?\s*([A-Z &]+)', text)
                branch_name = branch_match.group(1).title() if branch_match else None
                statement_period = {
                    "from": period_match.group(1).strip(),
                    "to": period_match.group(2).strip()
                } if period_match else None

                data['personal_details'] = {
                    'name': name,
                    'father_name': father_name,
                    'phone': phone,
                    'customer_id': customer_id,
                    'branch_name': branch_name,
                    'bank_address': bank_address,
                    'account_number': account_number,
                    'ifsc_code': ifsc_code,
                    'statement_period': statement_period
                }
            for page in pdf.pages:
                table = page.extract_table()
                if table:
                    header = table[0]
                    normal_table = all(len(row) == len(header) for row in table[1:])
                    if normal_table:
                        for row in table[1:]:
                            row_data = dict(zip(header, row))
                            transactions.append(row_data)
                    else:
                        if len(header) == 1:
                            col_lines = [row[0].split('\n') for row in table[1:]]
                            flat_lines = [item for sublist in col_lines for item in sublist if item.strip()]
                            if flat_lines:
                                possible_headers = flat_lines[0].split()
                                if 3 < len(possible_headers) < 8:
                                    header = possible_headers
                                    data_lines = flat_lines[1:]
                                    for i in range(0, len(data_lines), len(header)):
                                        chunk = data_lines[i:i+len(header)]
                                        if len(chunk) == len(header):
                                            row_data = dict(zip(header, chunk))
                                            transactions.append(row_data)
                                else:
                                    buffer = []
                                    for line in flat_lines:
                                        match = re.match(
                                            r'(\d{2}[\/\-]\w{3,9}[\/\-]\d{4})\s+(.+?)\s+((?:\d{1,3}(?:,\d{3})*|\d+)\.\d{2}|-)\s+((?:\d{1,3}(?:,\d{3})*|\d+)\.\d{2}|-)\s+((?:\d{1,3}(?:,\d{3})*|\d+)\.\d{2}|-)',
                                            line
                                        )
                                        if match:
                                            if buffer:
                                                transactions.append(buffer[-1])
                                                buffer = []
                                            transactions.append({
                                                'Date': match.group(1),
                                                'Description': match.group(2),
                                                'Debit': match.group(3),
                                                'Credit': match.group(4),
                                                'Balance': match.group(5)
                                            })
                                        else:
                                            if transactions:
                                                last_txn = transactions[-1]
                                                last_txn['Description'] += ' ' + line.strip()
                        else:
                            for row in table[1:]:
                                row_data = {}
                                for idx, col in enumerate(row):
                                    key = header[idx] if idx < len(header) else f'col{idx}'
                                    row_data[key] = col
                                transactions.append(row_data)
            if transactions:
                has_newline_other_than_desc = any(
                    any('\n' in str(v) for k, v in row.items() if 'desc' not in k.lower())
                    for row in transactions
                )
                if not has_newline_other_than_desc:
                    new_transactions = []
                    for row in transactions:
                        max_lines = max(
                            [len(str(v).split('\n')) for k, v in row.items() if 'desc' not in k.lower()] + [1]
                        )
                        split_cols = {k: str(v).split('\n') if 'desc' not in k.lower() else [v] for k, v in row.items()}
                        for i in range(max_lines):
                            new_row = {}
                            for k, vals in split_cols.items():
                                if 'desc' in k.lower():
                                    new_row[k] = vals[0].strip()
                                else:
                                    new_row[k] = vals[i].strip() if i < len(vals) else ''
                            if any(new_row.values()):
                                new_transactions.append(new_row)
                    transactions = new_transactions
            data['transactions'] = transactions
        # full_text = ''
        # for page in doc:
        #     full_text += page.get_text("text", sort=True)

        # personal = extract_personal_details(full_text)
        # transactions = extract_transactions(full_text)

        print(json.dumps({
            'data':data,
            # 'personal': personal,
            # 'transactions': transactions,
        }, indent=2))

    except Exception as e:
        print(json.dumps({'error': str(e)}))


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print(json.dumps({'error': 'PDF path required'}))
    else:
        pdf_path = sys.argv[1]
        pdf_password = sys.argv[2] if len(sys.argv) > 2 else None
        extract_content_from_pdf(pdf_path, pdf_password)
