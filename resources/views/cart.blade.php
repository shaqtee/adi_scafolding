@extends('layouts.public')
@section('css')
<style>
    *{
        margin:0;
        padding:0;
        font-family:'Lato', sans-serif;
    }

    a{
        color:#3ab0ff;
    }
    a:hover{
        color:#3adeff;
    }
    .myrow{
        border: 2px solid red;
    }
    .mycol{
        border: 2px solid blue;
    }

    .myimg{
        position: relative;
    }
    .mytext{
        position: absolute;
        top:0%;
        font-size:10vw;
        font-family:Impact, 'Haettenschweiler', 'Arial Narrow Bold', sans-serif;
    }

    @media (min-width:992px){
        .mytagparent{
            position: relative;;
        }
        .mytag::after{
            content:'H O T';
            font-size: 60%;
            text-align: center;
            position: absolute;
            background-color:#ffed4a;
            border-radius:10px ;
            padding: 0 10px;
            bottom: 31px;
            right:5px;
            font-weight:bold;
            color:black;
        }
        .mytag::before{
            position: absolute;
            content: '';
            width: 0px;
            border-top:4px solid #ffed4a;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            top:5px;
            left: 56%;
            transform:rotate(120deg)
        }
        .myfitur{
            display:none;
        }
    }

    @media(max-width:576px){
        .costummercareAndSocial{
            margin:auto;
        }
    }
    .formPengiriman{
        display:block;
        margin-bottom: 10px
    }
    #grupFormPengiriman{
        display:none;
    }

    .vendor{
        display:none;
    }
</style>
@endsection

@section('public_content')

<div class="container-fluid">
    <div class="row" style="background-color:#111111">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-dark p-0 py-2" style="background-color:#111111">
                <p class="text-white my-sm-auto costummercareAndSocial">OUR COSTUMER CARE : +62 81 29 777 29 46</p>
                <p class="my-auto ml-sm-auto costummercareAndSocial" >
                    <a href="#"><img width="15" class="mr-2" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im01MTIgMjU2YzAgMTQxLjM4NjcxOS0xMTQuNjEzMjgxIDI1Ni0yNTYgMjU2cy0yNTYtMTE0LjYxMzI4MS0yNTYtMjU2IDExNC42MTMyODEtMjU2IDI1Ni0yNTYgMjU2IDExNC42MTMyODEgMjU2IDI1NnptMCAwIiBmaWxsPSIjNGE3YWZmIi8+PHBhdGggZD0ibTI2Ny4yMzQzNzUgNTExLjczODI4MWMxMzYuMTcxODc1LTUuODc4OTA2IDI0NC43NjU2MjUtMTE4LjEyMTA5MyAyNDQuNzY1NjI1LTI1NS43MzgyODEgMC0uOTk2MDk0LS4wMjczNDQtMS45ODgyODEtLjAzOTA2Mi0yLjk4NDM3NWwtMTc3LjY5OTIxOS0xNzcuNzAzMTI1LTE5MCAxOTguNTkzNzUgMTA1LjU2NjQwNiAxMDUuNTY2NDA2LTQ4LjY3NTc4MSA2Ni4xODM1OTR6bTAgMCIgZmlsbD0iIzAwNTNiZiIvPjxwYXRoIGQ9Im0zMzQuMjYxNzE5IDc1LjMxMjV2NTcuOTY4NzVzLTY2LjU1NDY4OC05LjY2MDE1Ni02Ni41NTQ2ODggMzMuMjc3MzQ0djQyLjkzNzVoNjAuMTEzMjgxbC03LjUxMTcxOCA2NS40ODA0NjhoLTUyLjYwMTU2M3YxNzAuNjc5Njg4aC02Ni41NTQ2ODd2LTE3MC42Nzk2ODhsLTU2Ljg5NDUzMi0xLjA3NDIxOHYtNjQuNDA2MjVoNTUuODIwMzEzdi00OS4zNzg5MDZzLTMuNjgzNTk0LTczLjQ1NzAzMiA2OC43MDMxMjUtODYuOTQ5MjE5YzMwLjA1ODU5NC01LjYwNTQ2OSA2NS40ODA0NjkgMi4xNDQ1MzEgNjUuNDgwNDY5IDIuMTQ0NTMxem0wIDAiIGZpbGw9IiNmZmYiLz48cGF0aCBkPSJtMzM0LjI2MTcxOSAxMzMuMjgxMjV2LTU3Ljk2ODc1cy0zNS40MjE4NzUtNy43NS02NS40ODA0NjktMi4xNDQ1MzFjLTQuNjk1MzEyLjg3NS05LjA2MjUgMi4wMDc4MTItMTMuMTM2NzE5IDMuMzQ3NjU2djM2OS4xNDA2MjVoMTIuMDYyNXYtMTcwLjY3OTY4OGg1Mi41OTc2NTdsNy41MTU2MjQtNjUuNDgwNDY4aC02MC4xMTMyODFzMCAwIDAtNDIuOTM3NSA2Ni41NTQ2ODgtMzMuMjc3MzQ0IDY2LjU1NDY4OC0zMy4yNzczNDR6bTAgMCIgZmlsbD0iI2RjZTFlYiIvPjwvc3ZnPg=="/></a>
                    <a href="#"><img width="15" class="mr-2" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggc3R5bGU9ImZpbGw6IzAzQTlGNDsiIGQ9Ik01MTIsOTcuMjQ4Yy0xOS4wNCw4LjM1Mi0zOS4zMjgsMTMuODg4LTYwLjQ4LDE2LjU3NmMyMS43Ni0xMi45OTIsMzguMzY4LTMzLjQwOCw0Ni4xNzYtNTguMDE2DQoJYy0yMC4yODgsMTIuMDk2LTQyLjY4OCwyMC42NC02Ni41NiwyNS40MDhDNDExLjg3Miw2MC43MDQsMzg0LjQxNiw0OCwzNTQuNDY0LDQ4Yy01OC4xMTIsMC0xMDQuODk2LDQ3LjE2OC0xMDQuODk2LDEwNC45OTINCgljMCw4LjMyLDAuNzA0LDE2LjMyLDIuNDMyLDIzLjkzNmMtODcuMjY0LTQuMjU2LTE2NC40OC00Ni4wOC0yMTYuMzUyLTEwOS43OTJjLTkuMDU2LDE1LjcxMi0xNC4zNjgsMzMuNjk2LTE0LjM2OCw1My4wNTYNCgljMCwzNi4zNTIsMTguNzIsNjguNTc2LDQ2LjYyNCw4Ny4yMzJjLTE2Ljg2NC0wLjMyLTMzLjQwOC01LjIxNi00Ny40MjQtMTIuOTI4YzAsMC4zMiwwLDAuNzM2LDAsMS4xNTINCgljMCw1MS4wMDgsMzYuMzg0LDkzLjM3Niw4NC4wOTYsMTAzLjEzNmMtOC41NDQsMi4zMzYtMTcuODU2LDMuNDU2LTI3LjUyLDMuNDU2Yy02LjcyLDAtMTMuNTA0LTAuMzg0LTE5Ljg3Mi0xLjc5Mg0KCWMxMy42LDQxLjU2OCw1Mi4xOTIsNzIuMTI4LDk4LjA4LDczLjEyYy0zNS43MTIsMjcuOTM2LTgxLjA1Niw0NC43NjgtMTMwLjE0NCw0NC43NjhjLTguNjA4LDAtMTYuODY0LTAuMzg0LTI1LjEyLTEuNDQNCglDNDYuNDk2LDQ0Ni44OCwxMDEuNiw0NjQsMTYxLjAyNCw0NjRjMTkzLjE1MiwwLDI5OC43NTItMTYwLDI5OC43NTItMjk4LjY4OGMwLTQuNjQtMC4xNi05LjEyLTAuMzg0LTEzLjU2OA0KCUM0ODAuMjI0LDEzNi45Niw0OTcuNzI4LDExOC40OTYsNTEyLDk3LjI0OHoiLz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K"/></a>
                    <a href="#"><img width="15" class="mr-2" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDU1MS4wMzQgNTUxLjAzNCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTUxLjAzNCA1NTEuMDM0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgkNCgkJPGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8xXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyNzUuNTE3IiB5MT0iNC41NyIgeDI9IjI3NS41MTciIHkyPSI1NDkuNzIiIGdyYWRpZW50VHJhbnNmb3JtPSJtYXRyaXgoMSAwIDAgLTEgMCA1NTQpIj4NCgkJPHN0b3AgIG9mZnNldD0iMCIgc3R5bGU9InN0b3AtY29sb3I6I0UwOUIzRCIvPg0KCQk8c3RvcCAgb2Zmc2V0PSIwLjMiIHN0eWxlPSJzdG9wLWNvbG9yOiNDNzRDNEQiLz4NCgkJPHN0b3AgIG9mZnNldD0iMC42IiBzdHlsZT0ic3RvcC1jb2xvcjojQzIxOTc1Ii8+DQoJCTxzdG9wICBvZmZzZXQ9IjEiIHN0eWxlPSJzdG9wLWNvbG9yOiM3MDI0QzQiLz4NCgk8L2xpbmVhckdyYWRpZW50Pg0KCTxwYXRoIHN0eWxlPSJmaWxsOnVybCgjU1ZHSURfMV8pOyIgZD0iTTM4Ni44NzgsMEgxNjQuMTU2QzczLjY0LDAsMCw3My42NCwwLDE2NC4xNTZ2MjIyLjcyMg0KCQljMCw5MC41MTYsNzMuNjQsMTY0LjE1NiwxNjQuMTU2LDE2NC4xNTZoMjIyLjcyMmM5MC41MTYsMCwxNjQuMTU2LTczLjY0LDE2NC4xNTYtMTY0LjE1NlYxNjQuMTU2DQoJCUM1NTEuMDMzLDczLjY0LDQ3Ny4zOTMsMCwzODYuODc4LDB6IE00OTUuNiwzODYuODc4YzAsNjAuMDQ1LTQ4LjY3NywxMDguNzIyLTEwOC43MjIsMTA4LjcyMkgxNjQuMTU2DQoJCWMtNjAuMDQ1LDAtMTA4LjcyMi00OC42NzctMTA4LjcyMi0xMDguNzIyVjE2NC4xNTZjMC02MC4wNDYsNDguNjc3LTEwOC43MjIsMTA4LjcyMi0xMDguNzIyaDIyMi43MjINCgkJYzYwLjA0NSwwLDEwOC43MjIsNDguNjc2LDEwOC43MjIsMTA4LjcyMkw0OTUuNiwzODYuODc4TDQ5NS42LDM4Ni44Nzh6Ii8+DQoJDQoJCTxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfMl8iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iMjc1LjUxNyIgeTE9IjQuNTciIHgyPSIyNzUuNTE3IiB5Mj0iNTQ5LjcyIiBncmFkaWVudFRyYW5zZm9ybT0ibWF0cml4KDEgMCAwIC0xIDAgNTU0KSI+DQoJCTxzdG9wICBvZmZzZXQ9IjAiIHN0eWxlPSJzdG9wLWNvbG9yOiNFMDlCM0QiLz4NCgkJPHN0b3AgIG9mZnNldD0iMC4zIiBzdHlsZT0ic3RvcC1jb2xvcjojQzc0QzREIi8+DQoJCTxzdG9wICBvZmZzZXQ9IjAuNiIgc3R5bGU9InN0b3AtY29sb3I6I0MyMTk3NSIvPg0KCQk8c3RvcCAgb2Zmc2V0PSIxIiBzdHlsZT0ic3RvcC1jb2xvcjojNzAyNEM0Ii8+DQoJPC9saW5lYXJHcmFkaWVudD4NCgk8cGF0aCBzdHlsZT0iZmlsbDp1cmwoI1NWR0lEXzJfKTsiIGQ9Ik0yNzUuNTE3LDEzM0MxOTYuOTMzLDEzMywxMzMsMTk2LjkzMywxMzMsMjc1LjUxNnM2My45MzMsMTQyLjUxNywxNDIuNTE3LDE0Mi41MTcNCgkJUzQxOC4wMzQsMzU0LjEsNDE4LjAzNCwyNzUuNTE2UzM1NC4xMDEsMTMzLDI3NS41MTcsMTMzeiBNMjc1LjUxNywzNjIuNmMtNDguMDk1LDAtODcuMDgzLTM4Ljk4OC04Ny4wODMtODcuMDgzDQoJCXMzOC45ODktODcuMDgzLDg3LjA4My04Ny4wODNjNDguMDk1LDAsODcuMDgzLDM4Ljk4OCw4Ny4wODMsODcuMDgzQzM2Mi42LDMyMy42MTEsMzIzLjYxMSwzNjIuNiwyNzUuNTE3LDM2Mi42eiIvPg0KCQ0KCQk8bGluZWFyR3JhZGllbnQgaWQ9IlNWR0lEXzNfIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjQxOC4zMSIgeTE9IjQuNTciIHgyPSI0MTguMzEiIHkyPSI1NDkuNzIiIGdyYWRpZW50VHJhbnNmb3JtPSJtYXRyaXgoMSAwIDAgLTEgMCA1NTQpIj4NCgkJPHN0b3AgIG9mZnNldD0iMCIgc3R5bGU9InN0b3AtY29sb3I6I0UwOUIzRCIvPg0KCQk8c3RvcCAgb2Zmc2V0PSIwLjMiIHN0eWxlPSJzdG9wLWNvbG9yOiNDNzRDNEQiLz4NCgkJPHN0b3AgIG9mZnNldD0iMC42IiBzdHlsZT0ic3RvcC1jb2xvcjojQzIxOTc1Ii8+DQoJCTxzdG9wICBvZmZzZXQ9IjEiIHN0eWxlPSJzdG9wLWNvbG9yOiM3MDI0QzQiLz4NCgk8L2xpbmVhckdyYWRpZW50Pg0KCTxjaXJjbGUgc3R5bGU9ImZpbGw6dXJsKCNTVkdJRF8zXyk7IiBjeD0iNDE4LjMxIiBjeT0iMTM0LjA3IiByPSIzNC4xNSIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo="/></a>
                    <a href="#"><img width="15" class="" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSIwIC03NyA1MTIuMDAyMTMgNTEyIiB3aWR0aD0iNTEycHQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTUwMS40NTMxMjUgNTYuMDkzNzVjLTUuOTAyMzQ0LTIxLjkzMzU5NC0yMy4xOTUzMTMtMzkuMjIyNjU2LTQ1LjEyNS00NS4xMjg5MDYtNDAuMDY2NDA2LTEwLjk2NDg0NC0yMDAuMzMyMDMxLTEwLjk2NDg0NC0yMDAuMzMyMDMxLTEwLjk2NDg0NHMtMTYwLjI2MTcxOSAwLTIwMC4zMjgxMjUgMTAuNTQ2ODc1Yy0yMS41MDc4MTMgNS45MDIzNDQtMzkuMjIyNjU3IDIzLjYxNzE4Ny00NS4xMjUgNDUuNTQ2ODc1LTEwLjU0Mjk2OSA0MC4wNjI1LTEwLjU0Mjk2OSAxMjMuMTQ4NDM4LTEwLjU0Mjk2OSAxMjMuMTQ4NDM4czAgODMuNTAzOTA2IDEwLjU0Mjk2OSAxMjMuMTQ4NDM3YzUuOTA2MjUgMjEuOTI5Njg3IDIzLjE5NTMxMiAzOS4yMjI2NTYgNDUuMTI4OTA2IDQ1LjEyODkwNiA0MC40ODQzNzUgMTAuOTY0ODQ0IDIwMC4zMjgxMjUgMTAuOTY0ODQ0IDIwMC4zMjgxMjUgMTAuOTY0ODQ0czE2MC4yNjE3MTkgMCAyMDAuMzI4MTI1LTEwLjU0Njg3NWMyMS45MzM1OTQtNS45MDIzNDQgMzkuMjIyNjU2LTIzLjE5NTMxMiA0NS4xMjg5MDYtNDUuMTI1IDEwLjU0Mjk2OS00MC4wNjY0MDYgMTAuNTQyOTY5LTEyMy4xNDg0MzggMTAuNTQyOTY5LTEyMy4xNDg0MzhzLjQyMTg3NS04My41MDc4MTItMTAuNTQ2ODc1LTEyMy41NzAzMTJ6bTAgMCIgZmlsbD0iI2YwMCIvPjxwYXRoIGQ9Im0yMDQuOTY4NzUgMjU2IDEzMy4yNjk1MzEtNzYuNzU3ODEyLTEzMy4yNjk1MzEtNzYuNzU3ODEzem0wIDAiIGZpbGw9IiNmZmYiLz48L3N2Zz4="/></a>
                </p>
            </nav>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1F1F1F;">
                <img width="150" src="{{ asset('images/brand/sudah1.png') }}" alt="">
                <button class="navbar-toggler border border-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">BELANJA <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mytagparent">
                        <a class="nav-link mytag" href="#">PROMOSI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ACARA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">KONTAK</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="#" class="text-white-10">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="{{ url('/wishlist') }}" style="color:white;">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="myfitur">&nbsp; Daftar Keinginan</span>&nbsp;<span class="badge badge-warning countWishlist"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:white;">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="myfitur">&nbsp; Akun Saya</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:white;">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="myfitur">&nbsp; Keranjang</span>&nbsp;<span class="badge badge-warning countCart"></span>
                        </a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="row mt-3 text-white">
        <div class="col">
            <br><span><a class="" href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; Keranjang</span>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead class="">
                        <tr class="bg-info text-white shadow-md">
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $i => $p)
                        <tr class="{{ 'listKeranjang'.$i }}">
                            <th class="align-middle" scope="row"><a href="#" class="{{ 'produkKeranjang'.$i }}" data-key="{{ $i }}">X</a></th>
                            <td class="align-middle" scope="row"><img src="{{ $p[0]['foto'] }}" alt="" width="100"></td>
                            <td class="align-middle" scope="row"><a href="@if($produk[0][0]['foto'] != "https://place-hold.it/100x100"){{ url('/single/'.$p[0]['id']) }}@else # @endif">{{ $p[0]['nama_produk'] }}</a></td>
                            <td class="align-middle" scope="row">Rp {{ number_format($p[0]['harga'],0,",",".") }}</td>
                            <td class="align-middle" scope="row" width="200"><input type="number" class="col-sm-4 p-0 bg-dark text-center text-white mx-auto inputUpdateQty" value="{{ $p[1]['qty'] }}" data-id="{{ $p[1]['id'] }}"></td>
                            <td class="align-middle getSubTotal" scope="row" data-total="{{ $p[0]['harga'] * $p[1]['qty'] }}">Rp {{ number_format(($p[0]['harga'] * $p[1]['qty']),0,",",".") }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{--@php dd($produk[0][0]['foto'] != "https://place-hold.it/100x100") @endphp--}}
                    @if($produk[0][0]['foto'] != "https://place-hold.it/100x100")
                    <a class="btn col-sm-2 col-12 btn-dark text-white-50 border border-info my-3" id="btnUpdateKeranjang">Perbaharui Keranjang</a>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr class="divider" style="background-color:#111111">
        <div class="container">
        <div class="row row-cols-2 py-2" >
            <div class="input-group mb-3 col-md-6 col-12 my-3 p-0">
                <input type="text" class="form-control border border-info" placeholder="User's Coupon" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="input-group-text bg-dark border border-info text-white-50" id="basic-addon2">Terapkan Kupon</button>
                </div>
            </div>
        </div>
        </div>
    <hr class="divider" style="background-color:#111111">

    <div class="d-flex flex-row my-4">
        <h3 class="text-white ml-auto col-md-6">Total Keranjang Belanja</h3>
    </div>
    <div class="d-flex flex-row justify-content-end align-items-stretch">
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);">Subtotal</p>
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);" id="resultSubtotal"></p>
    </div>
    <div class="d-flex flex-row justify-content-end m-0 p-0">
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:#1a1a1a;">Pengiriman</p>
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);" id="commitPengiriman">POS - Paket Kilat Khusus (8 Days): Rp72.000 Dikirim Ke Jl.Inpres No.51, Balikpapan Utara, Muara Rapak, Kalimantan Timur 76128</p>
    </div>

    <div class="d-flex flex-row justify-content-end m-0 p-0">
    <a href="#" id="linkHitungBiayaPengiriman" style="background-color:rgb(26,26,26);" class="col-md-3 col-7">Ubah Alamat Pengiriman</a>
    </div>

    <form action="" method="" id="vendorPengiriman" class="ml-auto d-flex flex-column justify-content-end m-0 p-0 text-white col-md-3 col-7 ml-auto" style="background-color:#1a1a1a;">
        <div class="form-check vendor">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                POS - Express Next Day Barang (1 Day)
            </label>
        </div>
        <div class="form-check vendor">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                POS - Paket Kilat Khusus (2 Days)
            </label>
        </div>
        <div class="form-check vendor">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                TIKI - ECO (4 Days)
            </label>
        </div>
        <div class="form-check vendor">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                TIKI - ONS (1 Day)
            </label>
        </div>
        <div class="form-check vendor">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                TIKI - REG (2 Days)
            </label>
        </div>

    </form>

    <div class="d-flex flex-column justify-content-end m-0 p-0">
        <form action="" method="" class="justify-content-end" id="grupFormPengiriman">
            <select name="propinsi" id="" class="formPengiriman custom-select mt-1 col-md-3 ml-auto">
                <option selected>Propinsi</option>
                <option value="1">DKI Jakarta</option>
                <option value="2">Jawa Timur</option>
                <option value="3">Jawa Barat</option>
                <option value="3">Balikpapan</option>
            </select>
            <select name="kabupaten" id="" class="formPengiriman custom-select mt-1 col-md-3 ml-auto">
                <option selected>Kota/Kabupaten</option>
                <option value="1">Jakarta</option>
                <option value="2">Surabaya</option>
                <option value="3">Bandung</option>
                <option value="3">Balikpapan</option>
            </select>
            <select name="kecamatan" id="" class="formPengiriman custom-select mt-1 col-md-3 ml-auto">
                <option selected>Kecamatan</option>
                <option value="1">Bekasi</option>
                <option value="2">Rungkut</option>
                <option value="3">Panghegar</option>
                <option value="3">Muara Rapak</option>
            </select>
            <input class="formPengiriman mt-1 form-control col-md-3 ml-auto" type="text" placeholder="Kode Pos">
            <button class="formPengiriman btn btn-primary btn-sm mt-1 col-md-3 ml-auto">Perbaharui</button>
        </form>
    </div>
    <div class="d-flex flex-row justify-content-end">
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);">Total</p>
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);">Rp 85.000</p>
    </div>
    <div class="d-flex flex-row justify-content-end m-0 p-0 mb-5">
        <button class="btn btn-dark p-2 pl-3 text-white col-md-3 border border-info">Lanjutkan ke Checkout</button>
        <p class="p-2 pl-3 text-white col-md-3"></p>
    </div>
</div>

<div class="container-fluid">
    <div class="row" style="background-color:#111111">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-dark p-0 py-1" style="background-color:#111111">
                <p class="text-white mx-auto my-auto py-3">Alfabet Digital Shop developed by Sigma Intramedia.</p>
            </nav>
        </div>
    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- End of Scroll to Top Button-->

@endsection

@section('js')
<script>

    $('#linkHitungBiayaPengiriman').on('click',function(e){
        e.preventDefault();
        $('#grupFormPengiriman').toggle(500);
        $('.vendor').toggle(500);
        $('#commitPengiriman').toggle(500);
    })

    /* Button X */
    $('tbody tr th a').on('click', function(e){
        let namaKelas = e.target.className.toString(),
            key = $(this).attr('data-key');
        $('.' + namaKelas).parents()[1].remove();
        $.ajax({
            url:"{{ url('/cartdisaction') }}",
            type:"POST",
            dataType:"JSON",
            data: {
                _token:"{{ csrf_token() }}",
                key:key
            },
            success: function(data){
                console.log(data);
                location.reload();
            }
        })
    })

    /* Subtotal */
    let arrSubtotal = []

    $('.getSubTotal').each(function(){
        arrSubtotal.push($(this).data('total'));
    });

    let resultSubtotal = formatter.format(arrSubtotal.reduce(function(a,c){
        return a+c;
    }))

    $('#resultSubtotal').text(resultSubtotal)
    /* End Subtotal */

    /* Perbaharui Keranjang */
    $('.inputUpdateQty').on('keyup',function(e){
        let updateHarga = $(this).val();
        $('#btnUpdateKeranjang').removeClass('btn-dark').addClass('btn-primary')
    });

    $('#btnUpdateKeranjang').on('click', function(e){
        e.preventDefault();
        let arrUpdate = []
        $('.inputUpdateQty').each(function(){
            arrUpdate.push({"id":$(this).data('id'),"qty":$(this).val()})
        });
        $.ajax({
            url:"{{ url('/cartupdateaction') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                au:arrUpdate
            },
            success: function(data){
                console.log(data)
                location.reload();
            }
        })
        /*console.log(arrUpdate)*/
    });

</script>
@endsection

