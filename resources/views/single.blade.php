@extends('layouts/public')
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

    @media (min-width:0){
        /* horizontal scroll */
        .wrapperku{
            height:370px;
            width:1290px;
            border: 1px solid #aaa;

            background: #0f0c29;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #24243e, #302b63, #0f0c29); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            display:flex;
            overflow-x:scroll;
            scrollbar-width:none;
        }
        .barang{
            min-width:130px;
            height:320px;
            line-height:20px;
            text-align:center;
            background-color:rgb(255, 255, 255);
            margin-right: 3px;
            margin-top: 25px;
            border-radius:5px;
        }
        .itemSatu{
            margin-left:5px;
        }
        .iklan{
            margin-top:150px;
        }
        .iklanThumbnail{
            width:96%;
            transition:0.5s;
        }
        .iklanThumbnail:hover{
            transform: scale(1.2);
        }
        .loopBgKategori{
            background: #E0EAFC;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #CFDEF3, #E0EAFC);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #CFDEF3, #E0EAFC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    }

    #zoom-img {
        width: 338px;
        height: 338px;
        background-position: center;
        background-size: cover;
    }

</style>
@endsection

@section('public_content')

<!-- Topbar -->
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
<!-- End Topbar -->

<div class="container mt-3">

    <!-- Navbar -->
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
                        <a class="nav-link" href="{{url('/wishlist')}}" style="color:white;">
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
                        <a class="nav-link" href="{{ url('/cart') }}" style="color:white;">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="myfitur">&nbsp; Keranjang</span>&nbsp;<span class="badge badge-warning countCart"></span>
                        </a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Navbar -->

    <!-- Page Address -->
    <div class="row mt-3 text-white">
        <div class="col">
            <br><span><a class="" href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; <a href="#">Kategori</a> &nbsp;/&nbsp;Product</span>
        </div>
        <div class="col text-right">
            <br><a class="btn btn-dark borden border-primary" href="{{ url('/cart') }}" id="countCart">Lihat Keranjang - <span class="countCart"></span></a>
        </div>
    </div>
    <!-- End Page Address -->

    <!-- Main Content -->
    <div class="row mt-5 justify-content-center text-center text-white">

        <div class="col-md-2 col-4 text-right align-self-center">
            @if($fotoOptional === 'https://place-hold.it/100x100')
                @for($i=0;$i<3;$i++)
                <img class="mt-3 {{ 'fotoPlus'.$i }}" onclick="switchFoto(this)" src="{{ $fotoOptional }}" width="100" alt="">
                @endfor
            @else
                @foreach($fotoOptional as $i => $fo)
                <img class="mt-3 {{ 'fotoPlus'.$i }}" onclick="switchFoto(this)" src="{{ $fo->name }}" width="100" alt="">
                @endforeach
            @endif
        </div>
        <div class="col-md-5 col-8 text-left align-self-center">
            <div class="mt-3 border border-primary" id="zoom-img" style="width:27vmax;background:url('{{ $key->foto }}');"></div>
            {{--<img class="mt-3 border border-primary" style="width:27vmax;" src="{{ asset('images/produk/tayo.jpg') }}" alt="">--}}
        </div>

        <div class="col-md-5 mt-4 align-self-start text-center">
            <hr style="background-color:#aaa;">
            <h1 class="mt-3">{{ $key->nama_produk }}</h1>
            <h4>Rp {{ number_format($key->harga,0,",",".") }}</h4>
            <hr style="background-color:#aaa;">
            <h5>{{ $key->deskripsi }}</h5>
            <br>
            <div class="container row mx-auto justify-content-center">
                <button class="text-white minus" style="width:30px;height:30px;border:1px solid #aaa;background-color:transparent;">-</button>
                <input class="jumlahBarang mx-2 p-0 text-white text-center border border-primary" style="background-color:transparent;height:30px;width:50px;" type="text" value="0">
                <button class="text-white plus" style="width:30px;height:30px;border:1px solid #aaa;background-color:transparent;">+</button>
                <button class="btn btn-success btn-sm ml-4 align-self-center" id="cartSingle">Tambah ke keranjang</button>
                <a href="" class="text-white align-self-center ml-3" id="wishlist" data-id="{{ $key->id }}">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </a>
            </div>
            <hr class="mt-4" style="background-color:#aaa;">
        </div>
    </div>
    <div class="row mt-5 text-center">
        <div class="col">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <a href="#"class="tombolInformasiTambahan btn btn-secondary btn-sm active">INFORMASI TAMBAHAN</a>
                <a href="#"class="tombolUlasan btn btn-secondary btn-sm">ULASAN</a>
            </div>
        </div>
    </div>
    <div class="row mt-3 text-center text-white informasiTambahan">
        <div class="col">
            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti quas dicta labore! Deserunt distinctio ex dolor, a debitis quas aliquam.</h6>
        </div>
    </div>
    <div class="row mt-3 text-white ulasanDefault">
        <div class="col cobaUlasan">
            <h4>Ulasan :</h4>
            <p class="text-white-50">Belum ada ulasan.</p>
            <p class="text-white-50">Jadilah yang pertama memberikan ulasan "T-Shirt with Logo".</p>
            <p class="text-white-50">Rating Anda *&nbsp;&nbsp;&nbsp;
                <span class="bintang">
                    @for($i=0;$i<5;$i++)
                    <a href="" class="" id="star{{ $i }}" data-rating="{{ $i+1 }}">
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </a>
                    @endfor
                </span>
                <span id="nilai"></span>
            </p>
            <div class="form-group">
                <label class="text-white-50" for="exampleFormControlTextarea1">Ulasan Anda *</label>
                <textarea class="form-control text-white-50" id="exampleFormControlTextarea1" rows="3" style="background-color:#3d413f"></textarea>
            </div>
            <button class="btn btn-success">Kirim</button>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-6 border border-secondary p-3">
                <span class="text-white-50">KATEGORI : <a href="#">{{ strtoupper($key->kategori) }}</a></span>
            </div>
            <div class="col-6 border border-secondary p-3">
                <span class="text-white-50">TAG : <a href="#">{{ strtoupper($tagProduk) }}</a></span>
            </div>
        </div>

        <h4 class="text-white mt-3">Produk Terkait</h4>
        <div class="d-flex justify-content-center align-items-center rounded mt-4">
            <div class="wrapperku">
                <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                <div class="barang shadow itemSatu">
                    <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                    <hr class="bg-black">
                    <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                    <div class="mt-1"><b>Rp 500.000</b></div>
                    <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                    <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                </div>
                @for($i=0;$i<9;$i++)
                <div class="barang shadow">
                    <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                    <hr class="bg-black">
                    <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                    <div class="mt-1"><b>Rp 500.000</b></div>
                    <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                    <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                </div>
                @endfor
            </div>
        </div>
    </div>
    <!-- End Main Content -->

</div>



<!-- Footer -->
<div class="container-fluid mt-5">
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

    /* Swap Foto onclick */
    function switchFoto(req){
        let fotoKlik = req.src;
        let str = $('#zoom-img').attr('style');
        let patt = /https:\/\/.+\/\d{3}x\d{3}/gm;
        let fotoSwap = str.match(patt)[0];
        console.log(str)
        let strReplace = str.replace(patt,req.src)
        let fotoReplace = $('#zoom-img').attr('style',strReplace);
        req.src = fotoSwap;
    }

    /* Tombol Plus Minus */
    $('.minus').on('click', function(e){
        let click = 1;
        let jumlahBarang = parseInt($('.jumlahBarang').val()) - click;
        $('.jumlahBarang').val(jumlahBarang);
    })
    $('.plus').on('click', function(e){
        let click = 1;
        let jumlahBarang = parseInt($('.jumlahBarang').val()) + click;
        $('.jumlahBarang').val(jumlahBarang);
    });
    /* End Tombol Plus Minus */

    /* Ulasan Dan Informasi Tambahan */
    $('.ulasanDefault').css('display', 'none');
    $('.tombolUlasan').on('click',function(e){
        e.preventDefault();
        $('.informasiTambahan').css('display', 'none');
        $('.ulasanDefault').toggle(500);
    });
    $('.tombolInformasiTambahan').on('click',function(e){
        e.preventDefault();
        $('.ulasanDefault').css('display', 'none');
        $('.informasiTambahan').toggle(500);
    });
    /* End Ulasan dan Informasi Tambahan */

    /* 5 Stars */
    let rating = ' &nbsp;&nbspBelum Ada Penilaian';
    $('span#nilai').html(rating);

    $('.bintang a').on('click', function(e){
        e.preventDefault();
        $(this).siblings().removeClass("text-warning");
        $('#'+e.currentTarget.id).prevAll().toggleClass('text-warning');

        if ($('#'+e.currentTarget.id).attr('class') !== "text-warning"){
            $('#'+e.currentTarget.id).toggleClass('text-warning');
        };

        rating = parseInt($('#'+e.currentTarget.id).attr('data-rating'))
        switch(rating){
            case 1:
                rating = 'Buruk Sekali';
                break;
            case 2:
                rating = 'Lumayan';
                break;
            case 3:
                rating = 'Bagus';
                break;
            case 4:
                rating = 'Lebih Bagus';
                break;
            case 5:
                rating = 'Istimewa';
                break;
        }
        $('span#nilai').html('&nbsp;&nbsp'+rating);
    });
    /* End 5 Stars */

    /* Wishlist Cek Session */

    let cekprod = @php echo json_encode($key->id) @endphp || "";
    if(cekses.includes(cekprod.toString())){
        let cekClass = $('#wishlist').attr('class').split(' ')[0];
        if(cekClass == 'text-white'){
            $('#wishlist').toggleClass('text-white text-danger');
        }
    }


    console.log(cekses.length);

    /* Wishlist */
    $('#wishlist').on('click', function(e){
        e.preventDefault();
        $(this).toggleClass('text-white text-danger');
        let boolTrigger = $(this).attr('class').split(' ').pop();
        if(boolTrigger == 'text-white'){
            ajaxTrigger = true;
        }else{
            ajaxTrigger = false;
        }

        $.ajax({
            url:"{{ url('/wishlistaction') }}",
            type: "POST",
            dataType:"JSON",
            data: {
                _token:"{{ csrf_token() }}",
                at:ajaxTrigger,
                id:$('#wishlist').attr('data-id'),
                cs:cekses,
                cp:cekprod
            },
            success: function (data){
                $('.countWishlist').html(data.length);
            }
        });
    })
    /* End Wishlist */



    /* Add To Cart */
    $('#cartSingle').on('click', function(){
        let qtyBarang = $('.jumlahBarang').val(),
            id = $('#wishlist').attr('data-id');

        $.ajax({
            url:"{{ url('/cartaction') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                qb:qtyBarang,
                id:id,
                qty:"qty",
                mark:'id'
            },
            success: function(data) {
                console.log(data)
                $('.countCart').html(data.length);
            }
        })
    });

    /* Zoom FX */
    var addZoom = function (target) {
    // (A) FETCH CONTAINER + IMAGE
    var container = document.getElementById(target),
        imgsrc = container.currentStyle || window.getComputedStyle(container, false),
        imgsrc = imgsrc.backgroundImage.slice(4, -1).replace(/"/g, ""),
        img = new Image();

    // (B) LOAD IMAGE + ATTACH ZOOM
    img.src = imgsrc;
    img.onload = function () {
        var imgWidth = img.naturalWidth,
            imgHeight = img.naturalHeight,
            ratio = imgHeight / imgWidth,
            percentage = ratio * 100 + '%';

        // (C) ZOOM ON MOUSE MOVE
        container.onmousemove = function (e) {
        var boxWidth = container.clientWidth,
            rect = e.target.getBoundingClientRect(),
            xPos = e.clientX - rect.left,
            yPos = e.clientY - rect.top,
            xPercent = xPos / (boxWidth / 100) + "%",
            yPercent = yPos / ((boxWidth * ratio) / 100) + "%";

        Object.assign(container.style, {
            backgroundPosition: xPercent + ' ' + yPercent,
            backgroundSize: imgWidth + 'px'
        });
        };

        // (D) RESET ON MOUSE LEAVE
        container.onmouseleave = function (e) {
        Object.assign(container.style, {
            backgroundPosition: 'center',
            backgroundSize: 'cover'
        });
        };
    }
    };

    window.addEventListener("load", function(){
    addZoom("zoom-img");
    });
    /* End Zoom FX */
</script>
@endsection