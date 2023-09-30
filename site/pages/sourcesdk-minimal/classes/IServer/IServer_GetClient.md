<function name="GetClient" parent="IServer" type="classfunc">
	<description>
		Returns the client from the given slot
		<note>
			If you give it a slot which is not filled it can give you a somewhat coruppted IClient.  
			(Calling a function on this IClient causes a crash!)
		</note>
	</description>
	<source>https://github.com/OthmanAba/TeamFortress2/blob/master/tf2_src/engine/baseserver.h#L69</source>
	<realm>Server</realm>
	<args>
		<arg name="slot" type="int">The slot to get the client from</arg>
	</args>
	<rets>
		<ret name="client" type="IClient">The Client.</ret>
	</rets>
</function>