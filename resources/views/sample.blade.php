<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<select id="GetAllUser">
    <option value="">Select User</option>
    @foreach($users as $user)
        <option value="{{$user['id']}}">{{$user['name'] }}</option>
    @endforeach
</select>

<select id="GetAllType">
    <option value="">Select Type</option>
    <option value="parent">Parent</option>
    <option value="children">Children</option>
</select>

<select id="GetAllRole">
    <option value="">Select Role</option>
    @foreach($roles as $role)
        <option value="{{$role['id']}}">{{$role['title']}}</option>
    @endforeach
</select>

<button id="GetAllBtn">Get All</button>
<p id="GetAllShow"></p>

<br><br><br>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    let user = document.querySelector ( "#GetAllUser" );
    let type = document.querySelector ( "#GetAllType" );
    let role = document.querySelector ( "#GetAllRole" );

    $ ( "#GetAllBtn" ).click ( function () {
        let url = location.href + 'get-all';

        let data = {
            user: user.value,
            type: type.value,
            role: role.value,
        };

        $.get ( url, data, function (data) {
            let show = document.getElementById ( "GetAllShow" );
            show.textContent = JSON.stringify ( data, null, 2 );
        } )
    } );

    user.addEventListener('change', getRoles);

    type.addEventListener('change', getRoles);

    function getRoles (event){
        let url = location.href + 'get-roles';
        let data = {
            user: user.value,
            type: type.value
        }

        $.get(url, data, function (data) {
            let option = '';
            for (let i = 0; i < data.length; i++) {
                option += `<option value="${data[i]['id']}">${data[i]['title']}</option>`;
            }
            role.innerHTML = '<option value="">Select Role</option>' + option;
        });
    }

</script>
</body>
</html>
