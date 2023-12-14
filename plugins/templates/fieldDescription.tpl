<style>
    .wDescription{
        margin-top:20px;
        font-style: italic;
    }
    .wDescription h2{
        color: #000000;
    }
    .wDescription div{
        margin-top:10px;
    }
</style>

<div class="wDescription">
    <h2>Description</h2>
    {section name=index loop=$out}
        <div>
            {$out[index].Name}
            {$out[index].Description}
        </div>
    {/section}
</div>