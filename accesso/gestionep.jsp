<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <a href="index.html">Homepage </a><a href="logout.jsp">Esci</a><br>
        <h1>Inserimento prodotti</h1>
        <form action="gestionep.jsp" method="GET">
            <input type="text" id="nome" name="nome" placeholder="Nome"><br>
            <input type="number" id="quantita" name="quantita" placeholder="Quantità"><br>
            <input type="text" id="prezzo" name="prezzo" placeholder="Prezzo"><br>
            <input type="text" id="indirizzo" name="indirizzo" placeholder="Indirizzo"><br>
            <input type="text" id="supermercato" name="supermercato" placeholder="Supermercato"><br><br>
            <input type="submit" id="rpro" name="rpro" value="Inserisci">
        </form>

        <%  

        // Miglioramento: menu a tendina che permetta di scegliere tra i supermercati e colonna del proprietario nel database

            String nome, quantita, prezzo, supermercato, indirizzo, Driver="net.ucanaccess.jdbc.UcanaccessDriver";
            Connection connection;

            try{
                Class.forName(Driver);
            }
            catch (ClassNotFoundException e) {
                out.println("Impossibile caricare il Driver Ucanaccess");
            }
            try{
                connection=DriverManager.getConnection("jdbc:ucanaccess://" + request.getServletContext().getRealPath("/") + "Supermercati.accdb");
                nome=request.getParameter("nome");
                quantita=request.getParameter("quantita");
                prezzo=request.getParameter("prezzo");
                indirizzo=request.getParameter("indirizzo");
                supermercato=request.getParameter("supermercato");
                String query="INSERT INTO Prodotti (nome, quantita, prezzo, indirizzo, supermercato) VALUES ('"+nome+"','"+quantita+"','"+prezzo+"','"+indirizzo+"','"+supermercato+"')";
                String controllo = "SELECT nome FROM Prodotti WHERE nome = '"+nome+"';";
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(controllo);
                if (resultSet.next())
                    out.println("<p>Questa prodotto esiste già</p>");
                else if ((nome!="")&&(quantita!="")&&(prezzo!="")&&(indirizzo!="")&&(supermercato!="")&&(nome!="null")&&(quantita!=null)&&(prezzo!=null)&&(indirizzo!=null)&&(supermercato!=null))
                {
                    statement.executeUpdate(query);
                    out.println("<p>Registrazione compiuta con successo!</p>");
                }
                else if ((nome!="null")&&(quantita!=null)&&(prezzo!=null)&&(indirizzo!=null)&&(supermercato!=null))
                    out.println("<p>Dati mancanti</p>");
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