<function name="AddListener" parent="IGameEventManager2" type="classfunc">
	<description>adds a listener for a particular event.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L110</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="listener" type="IGameEventListener2">The listener to add</arg>
		<arg name="name" type="const char*">The event we want to listen for</arg>
		<arg name="bServerSide" type="bool">wheather the listener is serverside</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the listener was added successfully</ret>
	</rets>
</function>