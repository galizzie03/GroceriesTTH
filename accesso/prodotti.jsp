<!DOCTYPE html>
<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <a href="index.html">Homepage</a>  <a href="logout.jsp">Esci</a><br>
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
                connection=DriverManager.getConnection("jdbc:ucanaccess://"+request.getServletContext().getRealPath("/") + "Credenziali.accdb");
                String mostra = "SELECT Codice,Nome,Marca,Descrizione,Prezzo,Quantita FROM Prodotti WHERE Supermercato='"+supermercato+"'";
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(mostra);
                while(resultSet.next())
                {
                    out.println("<tr><td>"+resultSet.getString("Codice")+"</td>");
                    out.println("<td>"+resultSet.getString("Nome")+"</td>");
                    out.println("<td>"+resultSet.getString("Marca")+"</td>");
                    out.println("<td>"+resultSet.getString("Descrizione")+"</td>");
                    out.println("<td>€"+resultSet.getString("Prezzo")+"</td>");
                    out.println("<td>"+resultSet.getString("Quantita")+"</td></tr>");
                }

            out.println("<form action='prodotti.jsp?nome="+supermercato+"&?PartitaIVA="+tmp+" method='POST'>");
            %>
                <tr><td></td>
                <td><input type="text" id="nomeprodotto" name="nomeprodotto" placeholder="Nome"></td>
                <td><input type="text" id="marca" name="marca" placeholder="Marca"></td>
                <td><input type="text" id="descrizione" name="descrizione" placeholder="Descrizione"></td>
                <td><input type="number" id="prezzo" name="prezzo" placeholder="Prezzo"></td>
                <td><input type="number" id="quantita" name="quantita" placeholder="Quantità"></td></tr>
                </table><br>
                <input type="submit" id="inserimentoprodotti" name="inserimentoprodotti" value="Inserisci prodotto">
            </form>
        <%
            String nomeprodotto=request.getParameter("nomeprodotto");
            String marca=request.getParameter("marca");
            String descrizione=request.getParameter("descrizione");
            double prezzo=Double.parseDouble(request.getParameter("prezzo"));
            int quantita=Integer.parseInt(request.getParameter("quantita"));
            String inserimento="INSERT INTO Prodotti (Nome,Marca,Descrizione,Prezzo,Quantita,Supermercato) VALUES ('"+nomeprodotto+"','"+marca+"','"+descrizione+"','"+prezzo+"','"+quantita+"','"+supermercato+"')";
            statement.executeUpdate(inserimento);
            String dataValue=tmp;
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
        <br><br><a href="supermercati.jsp">Torna ai supermercati</a>
    </body>
</html>