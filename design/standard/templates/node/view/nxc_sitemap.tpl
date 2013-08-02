{let $depth=$node.depth|int()
     $siteurl = ""|ezroot('no', 'full')}

<url>
{if eq($node.class_identifier, 'file')}

    <loc>{concat(concat('content/download/', $node.data_map.file.contentobject_id, '/', $node.data_map.file.id)|ezroot('no', 'full'))|extlinkfix(del_layout)}</loc>
{else}

    <loc>{concat($node.url_alias|ezroot('no', 'full'))|extlinkfix(del_layout)}</loc>
{/if}

    <lastmod>{$node.object.modified|datetime( 'custom', '%Y-%m-%d' )}</lastmod>
    <priority>{if is_set($priority[$depth])}{$priority[$depth]}{else}{$priority[5]}{/if}</priority>
</url>

{if is_set($additional_url_parameters[$node.url_alias])}
{foreach $additional_url_parameters[$node.url_alias] as $additional_url}
<url>
    <loc>{concat(concat($node.url_alias,$additional_url)|ezroot('no', 'full'))|extlinkfix(del_layout)}</loc>
    <lastmod>{$node.object.modified|datetime( 'custom', '%Y-%m-%d' )}</lastmod>
    <priority>{if is_set($priority[$depth])}{$priority[$depth]}{else}{$priority[5]}{/if}</priority>
</url>
    
{/foreach}
{/if}