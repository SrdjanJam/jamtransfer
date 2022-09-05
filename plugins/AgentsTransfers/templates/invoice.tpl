{if $u.CountryName eq 'Serbia'}
        {include file="{$root}/plugins/{$base}/templates/invoiceSerbian.tpl"}
    {else}
        {include file="{$root}/plugins/{$base}/templates/invoiceForeign.tpl"}
{/if}