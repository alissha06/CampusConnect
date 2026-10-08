<?php
function ticket_status_label($s) {
    $labels = ['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved'];
    return $labels[$s] ?? $s;
}

function render_ticket_timeline(array $ticket, array $updates): void { ?>
  <ul class="ticket-timeline">
    <li>
      <span class="tl-dot"></span>
      <div>
        <strong>Ticket submitted</strong>
        <span class="tl-date"><?= date('d M Y, h:i A', strtotime($ticket['submitted_at'])) ?></span>
      </div>
    </li>
    <?php foreach ($updates as $u): ?>
    <li class="<?= $u['message'] !== null ? 'tl-reply' : '' ?>">
      <span class="tl-dot"></span>
      <div>
        <?php if ($u['status'] !== null): ?>
          <strong>Status changed to <?= htmlspecialchars(ticket_status_label($u['status'])) ?></strong>
        <?php endif; ?>
        <?php if ($u['message'] !== null): ?>
          <strong>Reply from admin</strong>
          <p><?= nl2br(htmlspecialchars($u['message'])) ?></p>
        <?php endif; ?>
        <span class="tl-date"><?= date('d M Y, h:i A', strtotime($u['created_at'])) ?></span>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
<?php }