  <?php


   putenv('GOOGLE_APPLICATION_CREDENTIALS=' .get_include_path().'/yourPath/client_secret.json');
        define('SCOPES', implode(' ', array(
                \Google_Service_Calendar::CALENDAR)
        ));

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setScopes(SCOPES);
        $client->setApplicationName("Client_Library_Examples");


        $service = new Google_Service_Calendar($client);

        $calendarList = $service->calendarList->listCalendarList();

        $googleApievent = new \Google_Service_Calendar_Event();
        $googleApievent->setSummary('TEST!!!!!!!!!!!');
        $googleApievent->setDescription('Test Description'); 
        $googleApievent->setLocation('London');

        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDate('2017-02-23');
        $start->setTimeZone('Europe/London');
        $start->setDate('2017-02-23');

        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDate('2017-02-23');
        $end->setTimeZone('Europe/London');
        $end->setDate('2017-02-23');

        $googleApievent->setStart($start);
        $googleApievent->setEnd($end);

        $calendarId = "{{ yourgmail@Adress }}";

        /*##################### INSERT AN EVENT ###################*/

        $createdEvent = $service->events->insert($calendarId, $googleApievent);
        echo $createdEvent->getId();


        foreach ($calendarList->getItems() as $calendarListEntry) {
                echo $calendarListEntry->getSummary() . "\n";
                // get events
                $events = $service->events->listEvents($calendarListEntry->id);



                foreach ($events->getItems() as $event) {
                    echo "<br/>" . $event->getSummary() . "";
                    echo " ID : " . $event->getId() . "<br/>";
                    echo "***********************" . "<br/> ";
                }
            }
            $pageToken = $calendarList->getNextPageToken();

        /*##################### UPDATE AN EVENT ###########################*/
        $updatedEvent = $service->events->get($calendarId, '{{ idEvent }}');
        $updatedEvent->setSummary('google api');
        $updatedEvent = $service->events->update($calendarId,$updatedEvent->getId(), $updatedEvent);
        echo $updatedEvent->getUpdated();


        /*##################### DELETE AN EVENT ###########################*/
        $deleteEvent = $service->events->get($calendarId, '{{ idEvent }}';
        $service->events->delete($calendarId, $deleteEvent->getId());
        echo "your event is deleted";
         


    }