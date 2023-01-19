<style type="text/css" media="print">

    body {
        font-family: 'Roboto', sans-serif;
        font-size: 10px !important;
        scroll-behavior: smooth;
    }
    .nav, .footer { display:none; }
    @page { margin: 0.5cm; }
    @media print {
        div [class*='col-'] { display: table-cell !important; }
        div [class*='row'] { display: table-row !important; width: 100%; }
        div [class*='grid'] { display: table-row !important; width: 100%; }
        div [class*='w25'] { display: inline-block !important; width: 30%; }
        div [class*='w75'] { display: inline-block !important; width: 69%; }
        div [class*='w100'] { display: inline-block !important; width: 99%; }
        button, .btn { display:none; }
    }
    .badge {
        background-color: white;
        color: black;
        padding: 4px 8px;
        text-align: center;
        border-radius: 5px;
    }


</style>
<style type="text/css" >
    /* Default: */
    .content {
        height: 100%;
        overflow: hidden;
        display: grid;

    }

    .header {
        grid-row: 1; 
    }
    .body{
        grid-row: 2;
        padding: 10px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .footer{
        grid-row: 3;
    }

</style>