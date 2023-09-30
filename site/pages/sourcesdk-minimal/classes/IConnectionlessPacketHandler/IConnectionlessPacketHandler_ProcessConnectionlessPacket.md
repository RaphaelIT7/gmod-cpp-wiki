<function name="ProcessConnectionlessPacket" parent="IConnectionlessPacketHandler" type="classfunc">
	<description>Processes incoming <page text="net packets">netpacket_t</page>.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/inetmsghandler.h#L214</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="msg" type="netpacket_t*">the net packet to progress</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the packet was successfully handled</ret>
	</rets>
</function>