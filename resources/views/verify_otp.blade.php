<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</html>