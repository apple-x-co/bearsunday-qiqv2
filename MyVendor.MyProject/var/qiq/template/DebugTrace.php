<h1>{{= $status['code'] }}</h1>
<h2>{{= $status['message'] }}</h2>

<p>logref: {{= $logref }}</p>
<p>request: {{= $request }}</p>
<p>exceptions: {{= $e['class'] }}({{= $e['message'] }})</p>

<p>Now: {{= CurrentDateTime()->format('Y-m-d H:i:s') }}</p>
