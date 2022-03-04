<!DOCTYPE html>

<html>
    <body>
        <table border="2">
        <a href="index.html">Homepage</a><br>
        <%
            String tmp = (String) request.getSession().getAttribute("email");
            if (tmp==null)
                response.sendRedirect("index.html");
            else
                out.print("<h1>Bentornato, "+tmp+".</h1>");
        %>
        <table border="2">
        <tr>
            <td>Codice</td>
            <td>Nome</td>
            <td>Marca</td>
        </tr>

    </body>
</html>