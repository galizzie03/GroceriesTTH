<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <a href="index.html">Homepage</a><br>
        <h1>Accesso proprietario</h1>
        <form action="accessop.jsp" method="GET">
            <input type="text" id="email" name="email" placeholder="Email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>
            <input type="submit" id="ac" name="ac" value="Accedi">
        </form>
        Non sei registrato? Registrati <a href="registrazionep.jsp">qui</a>!
    
        <%  
            String email, password, Driver = "net.ucanaccess.jdbc.UcanaccessDriver";
            Connection connection;

            try{
                Class.forName(Driver);
            }
            catch (ClassNotFoundException e) {
                out.println("Errore: Impossibile caricare il Driver Ucanaccess");
            }

            try{
                connection = DriverManager.getConnection("jdbc:ucanaccess://" + request.getServletContext().getRealPath("/") + "Credenziali.accdb");
                email=request.getParameter("email");
                password=request.getParameter("password");
                String query = "SELECT email FROM Proprietari WHERE email = '"+email+"'AND password = '"+password+"';"; 
                Statement statement=connection.createStatement();
                ResultSet resultSet=statement.executeQuery(query);

                if (resultSet.next())
                    response.sendRedirect("accessop.html");
                else
                    if((email!=null)&&(password!=null))
                        out.println("<p>L'email e/o la password contengono degli errori</p>");
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