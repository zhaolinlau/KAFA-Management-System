<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <div style="width: 400px;">
        <!-- Create activity form -->
        <form action="submit" method="post">
            @csrf
            <div>Activity : <input type="text" name="name" class="form-control"></div><br>
            <div>Location : <input type="text" name="location" class="form-control"></div><br>
            <div>Capacity : <input type="number" name="capacity" class="form-control"></div><br>
            <div>Date : <input type="datetime-local" name="date" class="form-control"></div><br>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>


</body>

</html>
