from aiosmtpd.controller import Controller

class CustomSMTPHandler:
    async def handle_DATA(self, server, session, envelope):
        print("---- NEW EMAIL RECEIVED ----")
        print("From:", envelope.mail_from)
        print("To:", envelope.rcpt_tos)
        print("Body:\n", envelope.content.decode('utf8', errors='replace'))
        print("-----------------------------")
        return '250 OK'

handler = CustomSMTPHandler()
controller = Controller(handler, hostname='localhost', port=1025)

print("SMTP Server running on localhost:1025...")
controller.start()

# Keep server alive
import time
while True:
    time.sleep(1)
