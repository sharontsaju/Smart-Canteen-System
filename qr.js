<html>
    <head>
        QR_CODE_SCANNING
    </head>
    <body>
        <div style="width: 500px" id="reader"></div>
        <script src="html5-qrcode.min.js"></script>
        <script>
        function onScanSuccess(qrCodeMessage) {
	// handle on success condition with the decoded message
}

var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);
    </script>
    </body>
</html>