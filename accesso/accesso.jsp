<%@ page import="java.io.*" %>
<%@ page import="java.sql.*" %>
<%@ page import="javax.sql.*" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
    <body>
        <a href="index.html">Homepage</a><br>
        <h1>Accesso</h1>
        <form action="accesso.jsp" method="GET">
            <input type="text" id="email" name="email" placeholder="Email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>
            <input type="submit" id="a" name="a" value="Accedi">
        </form>
        Non sei registrato? Registrati <a href="registrazione.jsp">qui</a>!
    
        <%  
            String email, password, Driver = "net.ucanaccess.jdbc.UcanaccessDriver";
            Connection connection;

            HttpSession s = request.getSession();
            
            try{
                Class.forName(Driver);
            }
            catch (ClassNotFoundException e) {
                out.println("Errore: Impossibile caricare il Driver Ucanaccess");
            }

            try{
                connection = DriverManager.getConnection("jdbc:ucanaccess://" + request.getServletContext().getRealPath("/") + "Credenziali.accdb");
                email = request.getParameter("email");
                password = request.getParameter("password");
                String queryp = "SELECT email FROM Utenti WHERE email = '"+email+"'AND password = '"+password+"' AND PartitaIVA IS NOT NULL;";
                String queryc = "SELECT email FROM Utenti WHERE email = '"+email+"'AND password = '"+password+"' AND PartitaIVA IS NULL;";
                Statement statement = connection.createStatement();

                ResultSet resultSet = statement.executeQuery(queryp);
                if (resultSet.next())
                {
                    String dataValue = email;
                    s.setAttribute("email",dataValue);
                    response.sendRedirect("supermercati.jsp");
                }
                else
                {
                    resultSet = statement.executeQuery(queryc);
                    if (resultSet.next())
                    {
                        String dataValue = email;
                        s.setAttribute("email",dataValue);
                        response.sendRedirect("browse.jsp");
                    }
                    else if ((email!=null)&&(password!=null))
                        out.println("<p>L'email o la password contengono degli errori</p>");
                }
            }
            catch(Exception e){
                out.println(e);
            }
            finally{
            }
        %>
    </body>
</html>