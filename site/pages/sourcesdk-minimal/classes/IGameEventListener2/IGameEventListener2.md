<type name="IGameEventListener2" category="classfunc" is="class">
	<summary>
# IGameEventListener2

File: [public/igameevent.h](https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L88-L96)
	</summary>
</type>

<example>
	<description>Example usage of this class</description>
	<code>
class CustomGameEventListener : public IGameEventListener2
{
public:
	CustomGameEventListener() = default;

	void FireGameEvent(IGameEvent* event)
	{
		if (strcmp(event->GetName(), "OnRequestFullUpdate") == 0) { // We check if the event is OnRequestFullUpdate
			Msg("Player at index %i had a full update!", event->GetInt("userid"))
		}
	}
}

SourceSDK::FactoryLoader engine_loader("engine");
IGameEventManager2* eventmanager = (IGameEventManager2*)engine_loader.GetFactory()(INTERFACEVERSION_GAMEEVENTSMANAGER2, nullptr); // We load the IGameEventManager2

CustomGameEventListener* EventListener = new CustomGameEventListener; // We create out Listener
eventmanager->AddListener(EventListener, "OnRequestFullUpdate", false); // We add our listener
	</code>
</example>