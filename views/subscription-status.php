<?php $tz = 0; ?>
<div class="narrow subscription-status">

<?php if($this->subscription->active): ?>
  <div class="bs bs-callout bs-callout-success">This subscription is active!</div>
<?php else: ?>
  <div class="bs bs-callout bs-callout-danger">This subscription is not active</div>
<?php endif; ?>

<h3>Subscription</h3>
<table class="table">
  <tr>
    <td>Feed URL (Topic)</td>
    <td><?= $this->feed->feed_url ?></td>
  </tr>
  <tr>
    <td>Callback URL</td>
    <td><?= $this->subscription->callback_url ?></td>
  </tr>
  <tr>
    <td>Date Subscription was Requested</td>
    <td><?= format_date($this->subscription->date_requested, $tz) ?></td>
  </tr>
  <tr>
    <td>Subscription Verification Response<br>(from your server)</td>
    <td><pre><?= htmlspecialchars($this->subscription->challenge_response) ?></pre></td>
  </tr>
  <tr>
    <td>Date Subscription was Confirmed</td>
    <td><?= format_date($this->subscription->date_confirmed, $tz) ?></td>
  </tr>
  <?php if($this->subscription->date_unsubscribed): ?>
    <tr>
      <td>Date Unsubscribed</td>
      <td><?= format_date($this->subscription->date_unsubscribed, $tz) ?></td>
    </tr>
  <?php endif; ?>
  <?php if($this->subscription->date_expires): ?>
    <tr>
      <td>Subscription Expiration</td>
      <td><?= format_date($this->subscription->date_expires, $tz) ?></td>
    </tr>
  <?php endif; ?>

</table>

<h3>Ping Info</h3>
<table class="table">
  <tr>
    <td>Last ping received from publisher</td>
    <td><?= format_date($this->feed->push_last_ping_received, $tz) ?></td>
  </tr>
  <tr>
    <td>Last ping sent to subscriber</td>
    <td><?= format_date($this->subscription->date_last_ping_sent, $tz) ?></td>
  </tr>
  <tr>
    <td>Last Response<br>(from your server)</td>
    <td><pre><?= htmlspecialchars($this->subscription->last_ping_headers."\n\n".$this->subscription->last_ping_body) ?></pre></td>
  </tr>
  <tr>
    <td>Last ping was successful?</td>
    <td><?= $this->subscription->last_ping_success ? 'Yes' : 'No' ?><br>(Subscriber must return 2xx on success)</td>
  </tr>
  <?php if($this->subscription->last_ping_success == 0): ?>
    <tr>
      <td>Retrying ping in</td>
      <td>
        <?= $this->subscription->last_ping_error_delay/2 ?> seconds<br>
        (Will be de-activated after 1 hour from first failed ping)
      </td>
    </tr>
  <?php endif; ?>
</table>

</div>
