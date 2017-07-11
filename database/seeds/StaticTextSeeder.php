<?php

use Illuminate\Database\Seeder;

use App\Model\StaticText;

class StaticTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $statics = [
          [
              'name'    => 'О компании',
              'alias'   => 'about',
          ],
          [
              'name'    => 'Контакты',
              'alias'   => 'contats',
          ],
          [
              'name'    => 'Правила сайта',
              'alias'   => 'rules',
          ],
          [
              'name'    => 'Политика конфиденциальности',
              'alias'   => 'policy',
          ],
          [
              'name'    => 'Пользовательское соглашение',
              'alias'   => 'term',
          ]
      ];

      foreach ($statics as $static) {
          $newStatic = StaticText::where('name', '=', $static['name'])->first();
          if ($newStatic === null) {
              $newStatic = StaticText::create(array(
                  'name'    => $static['name'],
                  'alias'	=> $static['alias'],
              ));
          }
      }
    }
}
