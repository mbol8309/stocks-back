<?php

namespace Database\Seeders;

use App\Models\Context;
use App\Models\Role;
use App\Models\Team;
use Illuminate\Database\Seeder;
use App\Models\User;

class ContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $users = User::all();
        foreach ($users as $user) {
            if ($user->context_id == null) {
                $c = new Context();
                $c->save();
                $user->context_id = $c->id;
                $user->save();
            }

        }

        $contexts = Context::where('name', '<>', 'global')->get();
        foreach ($contexts as $c) {
            if ($c->team_id == null) {
                $team = new Team([
                    'name' => 'rootteam-' . $c->id,
                    'description' => 'Base team for context',
                    'display_name' => "RootTeam({$c->id})"
                ]);
                $team->save();
                $c->team_id =  $team->id;
                $c->save();
            }
        }

        $g = Context::where('name', 'global')->first();
        if ($g == null) {
            //create global
            $g = new Context([
                'name' => 'global'
            ]);
        }
        if ($g->team_id == null) {
            $team = Team::where('name', 'global')->first();
            if ($team == null) {
                $team = new Team([
                    'name' => 'global',
                    'description' => 'Global Team',
                    'display_name' => "Global team"
                ]);
                $team->save();
            }


            $g->team_id = $team->id;
        }
        $g->save();

        $role = Role::where('name','admin')->first();
        if ($role==null)
        {
            $role = new Role([
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Can do anything'
            ]);
            $role->save();

            
        }

        foreach ($users as $user) {
            if ($user->roles()->count() == 0){
                $user->attachRoles([$role],Team::where('name','global')->first());
            }
        }
        

    }
}
