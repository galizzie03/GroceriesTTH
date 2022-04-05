<!DOCTYPE html>
<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <table border="2">
        <a href="index.html">Homepage </a><a href="logout.jsp">Esci</a><br>
        <%
            HttpSession s = request.getSession();
            String tmp = (String) request.getSession().getAttribute("email");
            if (tmp==null)
                response.sendRedirect("accesso.jsp");
            else
                out.print("<h1>Bentornato, "+tmp+". Seleziona il tuo supermercato.</h1>");
        %>
        <table border="2">
        <tr>
            <td>Nome</td>
            <td>Indirizzo</td>
        </tr>
        <%
            String Driver="net.ucanaccess.jdbc.UcanaccessDriver";
            Connection connection;
            try{
                Class.forName(Driver);
            }
            catch (ClassNotFoundException e) {
                out.println("Impossibile caricare il Driver Ucanaccess");
            }
            try{
                connection=DriverManager.getConnection("jdbc:ucanaccess://" + request.getServletContext().getRealPath("/") + "Credenziali.accdb");
                String controllo = "SELECT Supermercati.Nome, Supermercati.Indirizzo FROM Supermercati, Utenti WHERE Supermercati.PartitaIVA=Utenti.PartitaIVA AND Email='"+tmp+"'";
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(controllo);
                while(resultSet.next())
                {
                    out.println("<tr><td><a href='prodotti.jsp?nome="+resultSet.getString("Nome")+"&?PartitaIVA="+tmp+"'>"+resultSet.getString("Nome")+"</a></td>");
                    out.println("<td>"+resultSet.getString("Indirizzo")+"</td>");
                }
                out.println("</table>");
                String dataValue = tmp;
                s.setAttribute("email",dataValue);
                resultSet.close();
                statement.close();
                connection.close();
                }
            catch(Exception e){
                out.println(e);
            }
            finally{
                System.out.println("Connessione riuscita"); 
            }
        %>
    </body>
</html>