<!DOCTYPE html>

<html>
    <body>
        <a href="index.html">Homepage </a><a href="logout.jsp">Esci</a><br>
        <%
            String tmp = (String) request.getSession().getAttribute("email");
            if (tmp==null)
                response.sendRedirect("accesso.jsp");
            out.print("<h1>Bentornato, "+tmp+".</h1>");
            out.print("<a href=\"browse.html\">Scopri i supermercati vicino a te!</a><br>");
        %>
    </body>
</html>