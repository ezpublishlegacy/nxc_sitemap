
{let $depth=$node.depth|int()}
{let $siteurl = ""|ezroot('no', 'full')}

{if not($node.data_map.hide_in_sitemap.content)}
    {if array(392, 313, 271, 2473)|contains($node.node_id)|not()}
	{if ne($node.class_identifier, 'link')}
		<url>
			{if eq($node.class_identifier, 'file')}
				<loc>{concat(concat('content/download/', $node.data_map.file.contentobject_id, '/', $node.data_map.file.id)|ezroot('no', 'full'))|extlinkfix(del_layout)}</loc>
			{else}
				<loc>{concat($node.url_alias|ezroot('no', 'full'))|extlinkfix(del_layout)}</loc>
			{/if}
			<lastmod>{$node.object.modified|datetime( 'custom', '%Y-%m-%d' )}</lastmod>
			<priority>{if eq($depth, 1)}{$priority[0]}{else}{$priority[5]}{/if}</priority>
		</url>
	{/if}
    {/if}
{/if}
