<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form id="otpForm" method="POST" action="{{ route('verify_otp') }}" class="card p-4 text-center" style="width: 350px;">
            @csrf
            <input type="hidden" name="email" value="{{ $user->email }}">

            <h5 class="mb-4">Enter OTP Code</h5>

            <div id="otp-inputs" class="d-flex justify-content-center">
                <input type="text" class="form-control otp-input m-2 text-center" maxlength="1">
                <input type="text" class="form-control otp-input m-2 text-center" maxlength="1">
                <input type="text" class="form-control otp-input m-2 text-center" maxlength="1">
                <input type="text" class="form-control otp-input m-2 text-center" maxlength="1">
                <input type="text" class="form-control otp-input m-2 text-center" maxlength="1">
                <input type="text" class="form-control otp-input m-2 text-center" maxlength="1">
            </div>

            <!-- Hidden merged OTP -->
            <input type="hidden" id="otp_full" name="otp_code">

            <button type="submit" class="btn btn-primary mt-4 w-100">Verify OTP</button>

            <button type="button" id="resendOtpButton" class="btn btn-link mt-3" disabled>Resend OTP in 60s</button>
            <div id="resendMessage" class="text-center text-muted small mt-2"></div>
        </form>
    </div>

    <script>
        const inputs = document.querySelectorAll(".otp-input");
        const form = document.getElementById("otpForm");
        const otpFull = document.getElementById("otp_full");

        // Auto move to next box
        inputs.forEach((input, index) => {
            input.addEventListener("keyup", () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
        });

        // On submit → combine all boxes
        form.addEventListener("submit", (e) => {
            let otp = "";
            inputs.forEach(input => otp += input.value);
            otpFull.value = otp;
        });

        const resendOtpButton = document.getElementById('resendOtpButton');
        const resendMessage = document.getElementById('resendMessage');
        const email = '{{ $user->email }}';
        let countdown = 60;
        let countdownInterval = null;

        function updateResendButton() {
            if (countdown > 0) {
                resendOtpButton.textContent = `Resend OTP in ${countdown}s`;
                resendOtpButton.disabled = true;
            } else {
                resendOtpButton.textContent = 'Resend OTP';
                resendOtpButton.disabled = false;
            }
        }

        function startCountdown() {
            countdown = 60;
            updateResendButton();

            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            countdownInterval = setInterval(() => {
                countdown -= 1;
                updateResendButton();

                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                }
            }, 1000);
        }

        resendOtpButton.addEventListener('click', () => {
            if (countdown > 0) {
                return;
            }

            resendMessage.textContent = 'Sending OTP...';
            fetch('{{ route('resend_otp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ email }),
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Unable to resend OTP.');
                    }

                    resendMessage.textContent = data.message;
                    startCountdown();
                })
                .catch(error => {
                    resendMessage.textContent = error.message;
                    if (error.message.includes('Please wait')) {
                        const match = error.message.match(/(\d+) second/);
                        if (match) {
                            countdown = parseInt(match[1], 10);
                            startCountdown();
                        }
                    }
                });
        });

        startCountdown();
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</html>