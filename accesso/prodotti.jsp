<!DOCTYPE html>

<html>
    <body>
        <a href="index.html">Homepage</a><br>
        <%
            String tmp = (String) request.getSession().getAttribute("email");
            if (tmp==null)
                response.sendRedirect("index.html");
            out.print("<h1>Bentornato, "+tmp+".</h1>");
        %>
        
    </body>
</html>
