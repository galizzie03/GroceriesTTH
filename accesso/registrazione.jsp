<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <a href="index.html">Homepage</a><br>
        <h1>Registrazione utenti</h1>
        <form action="registrazione.jsp" method="GET">
            <input type="text" id="email" name="email" placeholder="Email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="text" id="nome" name="nome" placeholder="Nome"><br>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome"><br><br>
            Lasciare il seguente campo vuoto se si è un cliente.<br>
            <input type="text" id="iva" name="iva" placeholder="Partita IVA"><br>
            <input type="submit" id="rp" name="rp" value="Registrati">
        </form>
        Sei già registrato? accedi <a href="accesso.jsp">qui</a>!
    
        <%  
            String email, password, nome, cognome, iva, Driver="net.ucanaccess.jdbc.UcanaccessDriver";
            Connection connection;

            try{
                Class.forName(Driver);
            }
            catch (ClassNotFoundException e) {
                out.println("Impossibile caricare il Driver Ucanaccess");
            }

            try{
                connection=DriverManager.getConnection("jdbc:ucanaccess://" + request.getServletContext().getRealPath("/") + "Credenziali.accdb");
                email=      request.getParameter("email");
                password=   request.getParameter("password");
                nome=       request.getParameter("nome");
                cognome=    request.getParameter("cognome");
                iva=        request.getParameter("iva");
                String query =     "INSERT INTO Utenti (email, password, nome, cognome, partitaiva) VALUES ('"+email+"','"+password+"','"+nome+"','"+cognome+"','"+iva+"')";
                String controllo = "SELECT email, PartitaIVA FROM Utenti WHERE email='"+email+"' OR PartitaIVA='"+iva+"'";
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(controllo);

                if ((resultSet.next()&&email!=null)||(resultSet.next()&&iva!=null))
                    out.println("<p>Questa email o partita IVA è già associata ad un account esistente</p>");
                else if ((email!="")&&(password!="")&&(nome!="")&&(cognome!="")&&(iva!="")&&(email!=null)&&(password!=null)&&(nome!=null)&&(cognome!=null)&&(iva!=null))
                {
                    statement.executeUpdate(query);
                    out.println("<p>Registrazione proprietario compiuta con successo!</p>");
                }
                else if ((email!="")&&(password!="")&&(nome!="")&&(cognome!="")&&(email!=null)&&(password!=null)&&(nome!=null)&&(cognome!=null))
                {
                    statement.executeUpdate(query);
                    out.println("<p>Registrazione cliente compiuta con successo!</p>");
                }
                else
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