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
            String supermercato=request.getParameter("nome");
            if (tmp==null)
                response.sendRedirect("supermercati.jsp");
            else
                out.print("<h1>Supermercato "+supermercato+"</h1>");
        %>
        <table border="2">
        <tr>
            <td>Codice</td>
            <td>Nome</td>
            <td>Marca</td>
            <td>Descrizione</td>
            <td>Prezzo</td>
            <td>Quantità</td>
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
                String controllo = "SELECT Codice,Nome,Marca,Descrizione,Prezzo,Quantita FROM Prodotti WHERE Supermercato='"+supermercato+"'";
                String inserimento = "INSERT INTO Prodotti Codice,Nome,Marca,Descrizione,Prezzo,Quantita VALUES '"+codice+"','"+nome+"','"+marca+"','"+descrizione+"','"+prezzo+"','"+quantita+"'";
                String codice=request.getParameter("codice");
                String nome=request.getParameter("nome");
                String marca=request.getParameter("marca");
                String descrizione=request.getParameter("descrizione");
                double prezzo=request.getParameter("prezzo");
                int quantita=request.getParameter("quantita");
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(controllo);
                while(resultSet.next())
                {
                    out.println("<tr><td>"+resultSet.getString("Codice")+"</td>");
                    out.println("<td>"+resultSet.getString("Nome")+"</td>");
                    out.println("<td>"+resultSet.getString("Marca")+"</td>");
                    out.println("<td>"+resultSet.getString("Descrizione")+"</td>");
                    out.println("<td>"+resultSet.getString("Prezzo")+"</td>");
                    out.println("<td>"+resultSet.getString("Quantita")+"</td></tr>");
                }
        %>
            <form action="prodotti.jsp" method="GET">
            <tr><td><input type="text" id="codice" name="codice" placeholder="codice"></td>
            <td><input type="text" id="nome" name="nome" placeholder="nome"></td>
            <td><input type="text" id="marca" name="marca" placeholder="marca"></td>
            <td><input type="text" id="descrizione" name="descrizione" placeholder="descrizione"></td>
            <td><input type="number" id="prezzo" name="prezzo" placeholder="prezzo"></td>
            <td><input type="number" id="quantita" name="quantita" placeholder="quantita"></td></tr>
            </table>
            <input type="submit" id="inserimentoprodotti" name="inserimentoprodotti" value="inserimentoprodotti">
            </form>
        <%
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
        <br><a href="supermercati.jsp">Torna ai supermercati</a><br>

        <form action="post">
        <input type="hidden" id="custId" name="custId" value="Esci">
        </form>

    </body>
</html>