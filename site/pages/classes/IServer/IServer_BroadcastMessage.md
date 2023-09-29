<ambig page="IServer_BroadcastMessage2">You might be looking for the "IServer:BroadcastMessage" function, which takes a <page>IRecipientFilter</page> as a second argument.</ambig>
<function name="BroadcastMessage" parent="IServer" type="classfunc">
	<description>Bradcasts the given net message to all clients with the given requirements.</description>
	<source>https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/baseserver.cpp#L1592-L1595</source>
	<realm>Server</realm>
	<args>
		<arg name="msg" type="INetMessage&">the net message to broadcast</arg>
		<arg name="onlyActive" type="bool" default="false">only send the message to active clients</arg>
		<arg name="reliable" type="bool" default="false">send the msg reliable</arg>
	</args>
</function>