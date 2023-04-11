<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Yabx\Telegram\Utils;

exec('rm ' . __DIR__ . '/../src/Objects/*.php');

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



foreach ($docs as $doc) {
    $doc = trim($doc);
    if(!$doc) continue;

    preg_match('#<h4>.+</h4>#isu', $doc, $m);
    $name = strip_tags($m[0] ?? '');
    if(!preg_match('/^[A-Z][A-z]+$/', $name)) {
        //echo "Skip {$name}\n";
        continue;
    };
    //print_r($name);
    echo $name . PHP_EOL;

    $path = __DIR__ . '/../src/Objects/' . $name . '.php';

    $f = fopen($path, 'w');
    fwrite($f, "<?php\n\nnamespace Yabx\\Telegram\\Objects;\n\nuse InvalidArgumentException;\n\nclass {$name} {\n\n");

    preg_match('#<p>.+</p>#isu', $doc, $description);
    $description = strip_tags($description[0]);
    //print_r($description);

    preg_match_all('#<tr>(.+)</tr>#isU', $doc, $m);

    $props = $constructor = $methods = [];

    foreach ($m[0] as $line) {

        preg_match_all('#<td>(.+)</td>#isU', $line, $td);
        if(!$td[0]) continue;
        //print_r($td);
        [$key, $type, $description] = $td[1];
        $key = strip_tags($key);
        $type = $types[strip_tags($type)] ?? strip_tags($type);
        $description = html_entity_decode(strip_tags($description));

        $isArray = str_starts_with($type, 'Array of');
        $type = str_replace('Array of ', '', $type);
        $type = str_replace(' or ', '|', $type);

        $objectKey = Utils::toCamelCase($key);
        $optional = str_contains(strtolower($description), 'optional');

        $type = str_replace('Integer', 'int', $type);
        $type = str_replace('String', 'string', $type);
        $type = trim(str_replace('InputFile', '', $type), " |");

        $phpType = $type;
        if($isArray) $phpType = 'array';
        if($optional) {
            if(str_contains($type, '|')) $phpType .= '|null';
            else $phpType = '?' . $phpType;
        }
        $newType = trim(explode('|', $type)[0]);

        $props[] = '/**';
        $props[] = ' * ' . mb_convert_case(str_replace('_', ' ', $key), MB_CASE_TITLE);
        $props[] = ' *';
        $props[] = ' * ' . $description;
        $props[] = ' * @var ' . $type . ($isArray ? '[]' : '') . ($optional ? '|null' : '');
        $props[] = ' */';
        $props[] = 'protected ' . $phpType . ' $' . $objectKey . ($optional ? ' = null' : '') . ';' . PHP_EOL;


        $isObj = preg_match('/^[A-Z]/', $type);

        $constructor[] = 'if(isset($data[\'' . $key . '\'])) {';
        if($isArray) {
            $constructor[] = '    $this->' . $objectKey . ' = [];';
            $constructor[] = '    foreach($data[\'' . $key . '\'] as $item) {';
            $constructor[] = '        $this->' . $objectKey . '[] = ' . ($isObj ? 'new ' . $newType . '($item)' : '$item') . ';';
            $constructor[] = '    }';
        } else {
            $constructor[] = '    $this->' . $objectKey . ' = ' . ($isObj ? 'new ' . $newType . '($data[\'' . $key . '\'])' : '$data[\'' . $key . '\']') . ';';
        }
        $constructor[] = '}';

        $methods[] = 'public function ' . Utils::toCamelCase('get_' . $key) . '(): ' . $phpType . ' {';
        $methods[] = "\treturn \$this->{$objectKey};";
        $methods[] = '}' . PHP_EOL;

    }

    $props[] = 'protected array $rawData;' . PHP_EOL;

    foreach ($props as $prop) {
        fwrite($f, "\t{$prop}\n");
    }

    fwrite($f, "\tpublic function __construct(array \$data) {\n");
    fwrite($f, "\t\t\$this->rawData = \$data;\n");
    foreach ($constructor as $line) {
        fwrite($f, "\t\t{$line}\n");
    }
    fwrite($f, "\t}\n\n");

    $methods[] = 'public function getRawData(): array {';
    $methods[] = "\treturn \$this->rawData;";
    $methods[] = '}' . PHP_EOL;

    foreach ($methods as $line) {
        fwrite($f, "\t{$line}\n");
    }


    fwrite($f, "}\n");
    fclose($f);

    //if(!$props) unlink($path);

}
