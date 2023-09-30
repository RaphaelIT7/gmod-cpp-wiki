<function name="GetPlayerInfo" parent="IServer" type="classfunc">
	<description>Returns the current number of real players/clients.</description>
	<source>https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/baseserver.cpp#L880-L907</source>
	<realm>Server</realm>
	<args>
		<arg name="nClientIndex" type="int">Client index</arg>
		<arg name="pInfo" type="player_info_t">Player Info to fill</arg>
	</args>
	<rets>
		<ret name="success" type="bool">current number of real players/clients</ret>
	</rets>
</function>