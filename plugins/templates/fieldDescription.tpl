<style>
    .wDescription{
        margin-top:20px;
        padding:5px;
        /* font-style: italic; */
        background: #F8F9FA;
        border-radius: 5px;
        border: 1px solid rgb(197, 197, 197);
    }
    .wDescription h2{
        color: rgb(38, 172, 177);
    }
    .wDescription div{
        margin-top:10px;
    }
    .wDescription .row{
        margin-left: 0;
        margin-right: 0;
    }

    .add-row-label{
        color: rgb(22, 24, 24);
        font-weight: bold;
    }

    .add-row-item{
        border-bottom: 1px solid #dddddd;
    }
    .add-row-item:last-child{
        border:none;
    }
</style>

<div class="wDescription">
    <h2>Description section</h2>
    <div class="row add-row-label">
        <div class="col-sm-2">NAME</div>
        <div class="col-sm-10">DESCRIPTION</div>
    </div>
    {section name=index loop=$out}
        <div class="row add-row-item">
            <div class="col-sm-2">{$out[index].Name}</div>
            <div class="col-sm-10">{$out[index].Description}</div>
        </div>
    {/section}
</div>