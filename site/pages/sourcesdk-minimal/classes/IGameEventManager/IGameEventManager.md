<type name="IGameEventManager" category="classfunc" is="class">
	<summary>
# IGameEventManager2

File: [public/igameevent.h](https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L151-L188) 
Interface: **INTERFACEVERSION_GAMEEVENTSMANAGER** = **"GAMEEVENTSMANAGER001"**

<deprecated></deprecated>
	</summary>
</type>

<example>
	<description>Example on how to get this class</description>
	<code>
SourceSDK::FactoryLoader engine_loader("engine");
IGameEventManager2* eventmanager = (IGameEventManager2*)engine_loader.GetFactory()(INTERFACEVERSION_GAMEEVENTSMANAGER2, nullptr);

if(!eventmanager)
{
	Msg("Failed to get IGameEventManager2!\n");
}
	</code>
</example>