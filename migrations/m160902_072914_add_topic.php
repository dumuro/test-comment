<?php

use yii\db\Migration;

/**
 * Class m160902_072914_add_topic
 */
class m160902_072914_add_topic extends Migration
{
    public function up()
    {

        $this->insert('topic',[
            'name'         => 'Lorem Ipsum1',
            'alias'        => 'topic1',
            'text'         => $this->getText(),
            'is_published' => 1,
            'author'       => 'Alex',
            'create_date'  => new \yii\db\Expression('NOW()')
        ]);
        $this->insert('topic',[
            'name'         => 'Lorem Ipsum2',
            'alias'        => 'topic2',
            'text'         => $this->getText(),
            'is_published' => 1,
            'author'       => 'Alex',
            'create_date'  => new \yii\db\Expression('NOW()')
        ]);
        $this->insert('topic',[
            'name'         => 'Lorem Ipsum3',
            'alias'        => 'topic3',
            'text'         => $this->getText(),
            'is_published' => 1,
            'author'       => 'Alex',
            'create_date'  => new \yii\db\Expression('NOW()')
        ]);
        $this->insert('topic',[
            'name'         => 'Lorem Ipsum4',
            'alias'        => 'topic4',
            'text'         => $this->getText(),
            'is_published' => 1,
            'author'       => 'Alex',
            'create_date'  => new \yii\db\Expression('NOW()')
        ]);
        $this->insert('topic',[
            'name'         => 'Lorem Ipsum5',
            'alias'        => 'topic5',
            'text'         => $this->getText(),
            'is_published' => 1,
            'author'       => 'Alex',
            'create_date'  => new \yii\db\Expression('NOW()')
        ]);
    }

    public function down(){}

    private function getText()
    {
        return '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus urna nibh, quis laoreet ex tincidunt mollis. Nullam mauris tellus, venenatis et urna ut, malesuada ullamcorper mi. Nulla commodo pharetra augue, sed suscipit lorem placerat at. Quisque non vehicula sapien. In eget urna ac augue placerat laoreet. Ut nec justo porta, imperdiet leo at, ultrices lacus. Aliquam pharetra ultrices mauris, sit amet faucibus urna volutpat quis. Cras posuere, ex non mollis pulvinar, lorem tellus pellentesque mauris, non varius velit risus eu nunc. Donec id vulputate dolor. Donec varius, est quis sodales dignissim, sapien lectus feugiat dolor, ac accumsan velit neque in risus. Fusce varius arcu id sem faucibus dictum. Etiam et semper justo, et feugiat sem. Nulla molestie quis felis in vestibulum. Praesent tellus tortor, lobortis vel tempus sed, blandit non purus.</p>
                <p>Quisque mollis sem ac tortor dapibus eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam non sem placerat, fermentum nisl at, lacinia nibh. Donec ac convallis nulla. Morbi hendrerit ex ac libero egestas, nec tempus felis pulvinar. Aenean ac dolor id felis congue congue non id lectus. Nam varius suscipit consectetur. Integer sit amet arcu libero. Duis massa quam, dignissim ut cursus ac, pellentesque vitae ex. Quisque molestie mollis urna, quis facilisis magna faucibus ut. Pellentesque eget lectus lacinia, tristique ipsum eu, feugiat tortor.</p>
                <p>Aenean arcu purus, fermentum sed vehicula et, feugiat in odio. Vivamus scelerisque bibendum lacus, a efficitur magna tempus pretium. Pellentesque finibus libero nec augue dignissim, nec tincidunt urna pulvinar. Aliquam erat volutpat. Vestibulum fringilla rhoncus pretium. Proin odio ante, volutpat ut nunc ac, ornare aliquet ex. Duis porta consequat diam eget tincidunt. Mauris lacus magna, auctor finibus metus in, fringilla mattis lorem. Nunc sit amet fermentum eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo sapien. Proin sagittis dui sit amet nibh rhoncus, eget blandit metus hendrerit. Aliquam imperdiet facilisis ante at pulvinar. Morbi cursus vulputate nibh. Proin et erat convallis, blandit ante nec, sollicitudin nulla. Pellentesque at laoreet dui.</p>';
    }
}
