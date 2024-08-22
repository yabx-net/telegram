<?php

/**
 * This script is needed only for the development and initial generation of all methods.
 * Please DO NOT USE IT
 */

exit;

require_once __DIR__ . '/../vendor/autoload.php';

use Yabx\Telegram\Utils;


$doc = file_get_contents('https://core.telegram.org/bots/api');
$doc = str_replace('<h4>', '-----<h4>', $doc);
$docs = explode('-----', $doc);

$types = [
    'Integer' => 'int',
    'Float' => 'float',
    'Float number' => 'float',
    'String' => 'string',
    'Boolean' => 'bool',
    'InputFile' => '',
    'True' => 'bool',
];

$code = file_get_contents(__DIR__ . '/api.txt');

$methods = [];

foreach ($docs as $doc) {
    $doc = trim($doc);
    if(!$doc) continue;

    preg_match('#<h4>.+</h4>#isu', $doc, $m);
    $name = strip_tags($m[0] ?? '');
    if(!preg_match('/^[a-z][A-z]+$/', $name)) {
        //echo "Skip {$name}\n";
        continue;
    };
    //print_r($name);
    //echo $name . PHP_EOL;

    $method = "\tpublic function {$name}";

    //print_r($method);


    preg_match('#<p>.+</p>#isu', $doc, $description);
    $description = strip_tags($description[0]);

    $return = 'mixed';
    if(str_contains($description, 'Returns True on success')) $return = 'bool';
    elseif (preg_match('/returns\s.*([A-z]+) object/isU', $description, $m)) {
        $return = $m[1];
    } elseif(preg_match('/([A-z]+) is returned/isU', $description, $m)) {
        $return = $m[1];
    }
    if($return === 'True') $return = 'bool';

    //print_r($description);

    $args = $set = [];

    preg_match_all('#<tr>(.+)</tr>#isU', $doc, $m);
    foreach ($m[0] as $line) {

        preg_match_all('#<td>(.+)</td>#isU', $line, $td);
        if(!$td[0]) continue;
        [$key, $type, $required, $description] = $td[1];
        $key = strip_tags($key);
        $camelKey = Utils::toCamelCase($key);
        $required = $required === 'Yes';
        $optional = !$required;
        $type = $types[strip_tags($type)] ?? strip_tags($type);

        if(str_starts_with($type, 'Array of')) $type = 'array';
        $type = str_replace(' or ', '|', $type);
        $type = str_replace(array_keys($types), array_values($types), $type);
        if($type === '|string') $type = 'string';
        $description = html_entity_decode(strip_tags($description));
        //---

        $args[] = ($optional && !str_contains($type, '|') ? '?' : '') . "{$type} \${$camelKey}" . ($optional ? ' = null' : '');
        $set[] = "\t\t" . ($optional ? "if(isset($$camelKey)) " : "") . "\$params['{$key}'] = $$camelKey;";

        //echo "{$key} | {$type} | req={$required} | {$description}" . PHP_EOL;
        //
        //$isArray = str_starts_with($type, 'Array of');
        //$type = str_replace('Array of ', '', $type);
        //$type = str_replace(' or ', '|', $type);
        //
        //$objectKey = Utils::toCamelCase($key);
        //$optional = true;//str_contains(strtolower($description), 'optional');
        //
        //$type = str_replace('Integer', 'int', $type);
        //$type = str_replace('String', 'string', $type);
        //$type = trim(str_replace('InputFile', '', $type), " |");
        //
        //$phpType = $type;
        //if($isArray) $phpType = 'array';
        //if($optional) {
        //    if(str_contains($type, '|')) $phpType .= '|null';
        //    else $phpType = '?' . $phpType;
        //}
        //$newType = trim(explode('|', $type)[0]);
        //
        //$props[] = '/**';
        //$props[] = ' * ' . mb_convert_case(str_replace('_', ' ', $key), MB_CASE_TITLE);
        //$props[] = ' *';
        //$props[] = ' * ' . $description;
        //$props[] = ' * @var ' . $type . ($isArray ? '[]' : '') . ($optional ? '|null' : '');
        //$props[] = ' */';
        //$props[] = 'protected ' . $phpType . ' $' . $objectKey . ($optional ? ' = null' : '') . ';' . PHP_EOL;
        //
        //
        //$isObj = preg_match('/^[A-Z]/', $type);
        //
        //$fromArray[] = 'if(isset($data[\'' . $key . '\'])) {';
        //if($isArray) {
        //    $fromArray[] = '    $instance->' . $objectKey . ' = [];';
        //    $fromArray[] = '    foreach($data[\'' . $key . '\'] as $item) {';
        //    $fromArray[] = '        $instance->' . $objectKey . '[] = ' . ($isObj ? $newType . '::fromArray($item)' : '$item') . ';';
        //    $fromArray[] = '    }';
        //} else {
        //    $fromArray[] = '    $instance->' . $objectKey . ' = ' . ($isObj ? $newType . '::fromArray($data[\'' . $key . '\'])' : '$data[\'' . $key . '\']') . ';';
        //}
        //$fromArray[] = '}';
        //
        //$construct[] = "{$phpType} \${$objectKey}" . ($optional ? ' = null' : '') . ',';
        //$constructBody[] = "\$this->{$objectKey} = \${$objectKey};";
        //
        //$methods[] = 'public function ' . Utils::toCamelCase('get_' . $key) . '(): ' . $phpType . ' {';
        //$methods[] = "\treturn \$this->{$objectKey};";
        //$methods[] = '}' . PHP_EOL;
        //
        //$methods[] = 'public function ' . Utils::toCamelCase('set_' . $key) . '(' . $phpType .' $value): self {';
        //$methods[] = "\t\$this->{$objectKey} = \$value;";
        //$methods[] = "\treturn \$this;";
        //$methods[] = '}' . PHP_EOL;

    }

    usort($args, function ($a, $b) {
        if(str_contains($a, '= null') && !str_contains($b, '= null')) return 1;
        if(str_contains($b, '= null') && str_contains($a, '= null')) return -1;
        return 0;
    });

    $method .= '(' . implode(', ', $args) . '): ' . $return . ' { ' . PHP_EOL;
    $method .= "\t\t\$params = [];\n";
    $method .= implode("\n", $set) . PHP_EOL;
    if(preg_match('/^[A-Z]/', $return)) {
        $method .= "\t\treturn $return::fromArray(\$this->request('{$name}', \$params));\n";
    } else {
        $method .= "\t\treturn \$this->request('{$name}', \$params);\n";
    }
    $method .= "\t}";

    $methods[] = $method . PHP_EOL;

}

$code = str_replace('#METHODS', implode("\n", $methods), $code);
$code = str_replace("\t", "    ", $code);

file_put_contents(__DIR__ . '/../src/BotApiGenerated.php', $code);
