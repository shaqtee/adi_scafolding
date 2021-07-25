<style>
    .mynav{
            background-color:rgb(17,17,17);
        }
    .myfooter{
            background-color:rgb(17,17,17);
    }
    .myRow{
        border:2px solid red;
    }
    .myCol{
        border:2px solid blue;
    }
    .displayProduk{
        width:100%;
        transition: 0.3s;
    }
    .displayProduk:hover {
        transform:scale(1.1);
    }



    /* Scrollbar */
    ::-webkit-scrollbar{
        width:15px;
    }
    ::-webkit-scrollbar-track{
        box-shadow: 0 0 5px rgb(0, 0, 0);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb{
        background: rgb(202, 14, 155);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover{
        background: #000000;
    }

    .arrowP{
        position: relative;
    }

    @media(min-width:0){
        #cart {
            display:none;
        }
        .loginregister {
            display:none;
        }
    }

    @media (min-width:0){
        /* horizontal scroll */
        .wrapperku{
            height:370px;
            width:1290px;
            border: 1px solid #ddd;

            background: #2193b0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

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
            margin-top: 15px;
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
</style>
