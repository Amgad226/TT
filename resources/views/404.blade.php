<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>404 Error Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta https-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
          <div class="grid-row">
            <div class="colmun colmun-left">
              <h1 class="px-spc-b-20">404 ERROR.</h1>
              <h1 class="px-spc-b-20">We just have Arabic and English language.</h1>
              <span class="px-spc-b-20"> We work to add more languages for you. </span>
                <a style="font-size: 25px; color:red" href="/" class=" px-spc-b-20">Back to Home Page</a>

            </div>

          </div>
        </div>
      </div>
</body>
<style>
    * {
  padding: 0;
  margin: 0;
  outline: 0;
  color: rgb(255, 255, 255);
  box-sizing: border-box;
  font-family: 'IBM Plex Sans', sans-serif;
}
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    overflow: hidden;
    background-color: black
}
h1 {
  font-size: 50px;
  line-height: 60px;
}
span {
  display: block;
  font-size: 18px;
  line-height: 30px;
}
.container {
  width: 80%;
  max-width: 1600px;
  margin: auto;
}
.grid-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  place-items: center;
  grid-gap: 50px;
}
.colmun-left {
  text-align: left;
}
.colmun-right {
  text-align: right;
}
.px-spc-b-20 {
  padding-bottom: 20px;
}
</style>
</html>
