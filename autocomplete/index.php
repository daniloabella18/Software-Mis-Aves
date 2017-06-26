<html>
    <head>
        <script src="js/jquery1.7.1.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
        <script type="text/javascript">
            $(function() {
                availableSports = ["Basketball","Football","Baseball"];
                   $("#sport").autocomplete({
                	source: availableSports
                    });
            });
            function loadSportsTeams(){
                //Gets the name of the sport entered.
                var sportSelected= $("#sport").val();
                var teamList = "";
                $.ajax({
                    url: 'sportsTeams.php',
                    type: "POST",
                    async: false,
                    data: { sport: sportSelected}
                 }).done(function(teams){
                    teamList = teams.split(',');
                 });
                //Returns the javascript array of sports teams for the selected sport.
                return teamList;
            }
            function autocompleteSportsTeams(){
                var teams = loadSportsTeams();
                $("#sportsTeam").autocomplete({
                     source: teams
                 });
             }
        </script>
    </head>
    <body>
        Sport: <input type="text" id="sport" name="sport" onblur="autocompleteSportsTeams()"></input>
        Sports Team: <input type="text" id="sportsTeam" name="sportsTeam"></input>
    </body>
</html>