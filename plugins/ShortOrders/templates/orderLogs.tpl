<ul class="timeline">
	{section name=ind loop=$logs}
		<li class="time-label">
			<span class="bg-light-blue">
				{$logs[ind].DateAdded}
			</span>
		</li>
		<li>
			<i class="{$logs[ind].Icon}"></i>
			<div class="timeline-item">
				<span class="time">
					<i class="fa fa-clock-o"></i> {$logs[ind].TimeAdded}
				</span>
				<span class="timeline-header">
					{$logs[ind].Title}
				</span>

				<div class="timeline-body">
					{$logs[ind].Description}
				</div>
			</div>
		</li>
	{/section}
</ul>
