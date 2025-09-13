import asyncio
from websockets.asyncio.server import serve
import json

users = {}

async def echo(ws):
    name = None
    try:
        async for msg in ws:
            try:
                data = json.loads(msg)
                msg_type = data.get("type")
                print("Received:", data)

                if data["type"] == "login":
                    name = data["name"]
                    users[name] = ws
                    await ws.send(json.dumps({"type": "login", "success": True}))

                elif msg_type in ["offer", "answer", "candidate", "leave"]:
                    target_name = data.get("target")
                    if target_name and target_name in users:
                        target_ws = users[target_name]
                        data["name"] = name
                        await target_ws.send(json.dumps(data))
                    else:
                        print(f"User {target_name} not found for message type {data}")

            except Exception as e:
                print("Message error:", e)

    except Exception as e:
        print("Connection closed:", e)
    finally:
        if name in users:
            del users[name]

async def main():
    print("Starting WebSocket signaling server on ws://localhost:3000")
    async with serve(echo, "0.0.0.0", 3000) as server:
        await server.serve_forever()
if __name__ == "__main__":
    asyncio.run(main())
