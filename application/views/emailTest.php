<body style="padding-top: 70px;">
    <nav class="navbar navbar-inner navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <span><img id="logo"  src="<?= base_url("images/unidissLogo.png") ?>" height="28">
                        UniDiss</span></a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Email test</h1>

        <form method="post" action="processEmail">
            <div class="form-group">
                <input type="text" name="subject" class="form-control input-md" placeholder="Insert Subject" required>
            </div>
            <div class="form-group">
                <textarea name="content"  class="form-control input-md" placeholder="Write email" required></textarea>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-success btn-md">Send Email</button>
            </div>
        </form>
    </div>



</body>
</html>