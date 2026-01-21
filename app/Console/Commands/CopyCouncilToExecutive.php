<?php

namespace App\Console\Commands;

use App\Models\CouncilMember;
use App\Models\ExecutiveCouncilMember;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class CopyCouncilToExecutive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Options:
     * --dry     Perform a dry run without writing to the database
     * --force   Overwrite existing ExecutiveCouncilMember rows with same slug
     * --chunk=  Chunk size for processing (default: 200)
     */
    protected $signature = 'council:copy-to-executive {--dry} {--force} {--chunk=200}';

    /**
     * The console command description.
     */
    protected $description = 'Copy data from council_members to executive_council_members with safe mapping.';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry');
        $force = (bool) $this->option('force');
        $chunk = (int) $this->option('chunk');
        if ($chunk < 1) {
            $this->error('Chunk size must be >= 1');
            return self::FAILURE;
        }

        $this->info(sprintf('Starting copy (dry-run: %s, force: %s, chunk: %d)...', $dryRun ? 'yes' : 'no', $force ? 'yes' : 'no', $chunk));

        $created = 0;
        $updated = 0;
        $skipped = 0;
        $total = 0;

        CouncilMember::query()
            ->orderBy('id')
            ->chunkById($chunk, function (Collection $members) use (&$created, &$updated, &$skipped, &$total, $dryRun, $force) {
                foreach ($members as $member) {
                    $total++;
                    $payload = [
                        'name' => $member->name,
                        'position' => $member->position,
                        'slug' => $member->slug,
                        'image' => $member->image,
                        'biography' => is_array($member->biography) ? json_encode($member->biography) : $member->biography,
                        'display_order' => (int) ($member->sort_order ?? 0),
                        'is_active' => (bool) $member->is_active,
                    ];

                    /** @var ExecutiveCouncilMember|null $existing */
                    $existing = ExecutiveCouncilMember::query()->where('slug', $member->slug)->first();

                    if ($existing) {
                        if ($force) {
                            if ($dryRun) {
                                $updated++;
                                $this->line("[dry] would update executive member slug={$member->slug}");
                            } else {
                                $existing->fill($payload);
                                $existing->save();
                                $updated++;
                                $this->line("updated executive member slug={$member->slug}");
                            }
                        } else {
                            $skipped++;
                            $this->line("skipped existing executive member slug={$member->slug}");
                        }

                        continue;
                    }

                    if ($dryRun) {
                        $created++;
                        $this->line("[dry] would create executive member slug={$member->slug}");
                    } else {
                        ExecutiveCouncilMember::create($payload);
                        $created++;
                        $this->line("created executive member slug={$member->slug}");
                    }
                }
            });

        $this->newLine();
        $this->info('Copy complete.');
        $this->table(['total', 'created', 'updated', 'skipped'], [[
            $total, $created, $updated, $skipped,
        ]]);

        return self::SUCCESS;
    }
}
