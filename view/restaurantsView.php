<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurants</title>
    </head>
    <body>
        <h1>Restaurant Management</h1>
        <form action="../controller/restaurant.php" method="post">
            Name: 
            <input type="text" name="name">
            <br><br>

            Location: 
            <input type="text" name="location">
            <br><br>

            Area: 
            <input type="text" name="area">
            <br><br>

            Short Background: 
            <input type="text" name="short_background">
            <br><br>

            Goals: 
            <textarea name="goals"></textarea>
            <br><br>

            <input type="submit" value="Add Restaurant" name = "add_restaurant">
        </form>
    </body>
    </html>