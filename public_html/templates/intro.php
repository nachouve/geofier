<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

<style>
body { 
    font-family: "Arial", "Garuda","Lucida Sans Unicode"; 
    font-size: 0.8em; 
    margin: 0 15%;
}
blockquote{
    font-size: 1.2em; 
    font-family: "Garuda","Lucida Sans Unicode","Arial"; 
    margin:1em 0;
    padding:0.5em 1em;
    border:1px solid rgba(0,0,0,.1);
    border-left:8px solid #41b7db;
    background-color:#f7f7f7;
    color:rgba(0,0,0,.75)
}

</style>

</head>
<body>
<h1><img src="images/geofier-logo.png" height="100px"/> Geofier Site </h1>

<blockquote>
  <h3>Geofier API</h3>
  <a href="api">Test API functions</a>
</blockquote>

<blockquote>
  <h3>More info for Developers</h3>
  <li>More info at: <a href=https://github.com/nachouve/geofier/blob/master/README.md>Github Readme</a></li>
  <li>Source code at: <a href=https://github.com/nachouve/geofier>Github</a></li>
</blockquote>

<div id="github_readme">
</div>
<script>
   $('#github_readme').load('http://markdown.io/https://raw.github.com/nachouve/geofier/master/README.md #md-content');
</script>
</body>
</html>
