<function name="GetSpawnCount" parent="IServer" type="classfunc">
	<description>
		Returns the number of servers spawned since start
		<note>
			This will count up every time a map is loaded/a server is created.  
			This will only reset when the server is restarted.  
		</note>
	</description>
	<source>https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/baseserver.h#L76</source>
	<realm>Server</realm>
	<rets>
		<ret name="m_nSpawnCount" type="int">The Spawn Count.</ret>
	</rets>
</function>