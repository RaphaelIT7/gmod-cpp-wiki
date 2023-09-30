<function name="GetNumClasses" parent="IServer" type="classfunc">
	<description>
		Returns the number of unique server classes
		<note>
			it internally returns [m_nSpawnCount](https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/baseserver.h)
		</note>
	</description>
	<source>https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/baseserver.h#L77</source>
	<realm>Server</realm>
	<rets>
		<ret name="m_nSpawnCount" type="int">number of unique server classes.</ret>
	</rets>
</function>