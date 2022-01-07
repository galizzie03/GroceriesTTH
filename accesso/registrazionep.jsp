<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <a href="index.html">Homepage</a><br>
        <h1>Registrazione proprietario</h1>
        <form action="registrazionep.jsp" method="GET">
            <input type="text" id="email" name="email" placeholder="Email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="text" id="nome" name="nome" placeholder="Nome"><br>
            <input type="text" id="cognome" name="cognome" placeholder="Cognome"><br><br>
            <input type="submit" id="rp" name="rp" value="Registrati">
        </form>
        Sei già registrato? accedi <a href="accessop.jsp">qui</a>!
    
        <%  
            String email, password, nome, cognome, Driver="net.ucanaccess.jdbc.UcanaccessDriver";
            Connection connection;

            try{
                Class.forName(Driver);
            }
            catch (ClassNotFoundException e) {
                out.println("Impossibile caricare il Driver Ucanaccess");
            }

            try{
                connection=DriverManager.getConnection("jdbc:ucanaccess://" + request.getServletContext().getRealPath("/") + "Credenziali.accdb");
                email=request.getParameter("email");
                password=request.getParameter("password");
                nome=request.getParameter("nome");
                cognome=request.getParameter("cognome");
                String query="INSERT INTO Proprietari (email, password, nome, cognome) VALUES ('"+email+"','"+password+"','"+nome+"','"+cognome+"')";
                String controllo = "SELECT email FROM Proprietari WHERE email = '"+email+"';"; 
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(controllo);
                if (resultSet.next()&&email!=null)
                    out.println("<p>Questa email è già associata ad un account esistente</p>");
                else if ((email!="")&&(password!="")&&(nome!="")&&(cognome!="")&&(email!="null")&&(password!=null)&&(nome!=null)&&(cognome!=null))
                {
                    statement.executeUpdate(query);
                    out.println("<p>Registrazione compiuta con successo!</p>");
                }
                else if ((email!="null")&&(password!=null)&&(nome!=null)&&(cognome!=null))
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