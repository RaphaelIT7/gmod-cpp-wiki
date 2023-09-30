# < structure >

<title>netpacket_t</title>
<structure>
	<source>https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/net.h#L107-L118</source>
	<realm>Shared and Menu</realm>
	<description>
		The [netpacket_t](https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/net.h#L107-L118) structure
		<note>
			**netpacket_t** and **netpacket_s** are the same.
		</note>
	</description>
	<fields>
		<item name="from" type="netadr_t"></item>
		<item name="source" type="int"></item>
		<item name="received" type="double"></item>
		<item name="data" type="unsigned char*"></item>
		<item name="message" type="bf_read"></item>
		<item name="size" type="int"></item>
		<item name="wiresize" type="int"></item>
		<item name="stream" type="bool"></item>
		<item name="pNext" type="netpacket_s*"></item>
	</fields>
</structure>