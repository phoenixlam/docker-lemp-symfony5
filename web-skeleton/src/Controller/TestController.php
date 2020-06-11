<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;

/**
 * https://www.doctrine-project.org/projects/doctrine-dbal/en/2.10/reference/data-retrieval-and-manipulation.html
 */
class TestController
{
    /**
     * @Route("/test/json")
     */
    public function testJson()
    {
        return new JsonResponse(['test'=>'json response']);
    }
    
    /**
     * @Route("/test/html")
     */
    public function testHtml()
    {
        return new Response('<html><body>test pure html</body></html>');
    }

    /**
     * @Route("/test/log")
     * 
     * Reference: https://github.com/php-fig/log/blob/master/Psr/Log/LoggerInterface.php
     * Example:
     *     [2020-06-04T06:21:26.896333+00:00] app.INFO: test log info with context {"hello":"world"} []
     *     TODO support __METHOD__
     */
    public function testLog(LoggerInterface $logger)
    {
        $logger->emergency('test log emergency');
        $logger->alert(    'test log alert');        
        $logger->critical( 'test log critical');
        $logger->error(    'test log error');
        $logger->warning(  'test log warning');
        $logger->notice(   'test log notice');
        $logger->info(     'test log info with context', ['hello'=>'world']);
        $logger->debug(    'test log debug');

        return new Response('<html><body>test compelete, pls check log file var/log/dev.log</body></html>');
    }
    
    /**
     * @Route("/test/mysql/insert")
     */
    public function testMysqlInsert(Connection $connection)
    {
        $sql = "INSERT INTO testtable SET col_varchar=? ";
        
        $affectedRows1 = $connection->executeUpdate($sql, array(
            'i'.date('Ymd His')
        ));
                
        $affectedRows2 = $connection->insert('testtable', 
            array('col_varchar'=>'i'.date('Ymd His'))
        );
        
        return new JsonResponse(['affectedRows1'=>$affectedRows1, 'affectedRows2'=>$affectedRows2]);
    }
    
    /**
     * @Route("/test/mysql/select-one")
     */
    public function testMysqlSelectOne(Connection $connection)
    {
        $row = $connection->fetchAssoc('SELECT * FROM testtable WHERE id=? ',  array(4));
        
        return new JsonResponse(['firstRow'=>$row]);
    }
    
    /**
     * @Route("/test/mysql/select-many")
     */
    public function testMysqlSelectMany(Connection $connection)
    {
        $rows = $connection->fetchAll('SELECT * FROM testtable');
        
        return new JsonResponse(['rows'=>$rows]);
    }
    
    /**
     * @Route("/test/mysql/update")
     */
    public function testMysqlUpdate(Connection $connection)
    {
        $sql = "UPDATE testtable SET col_varchar=? WHERE id=? ";
        
        $affectedRows = $connection->executeUpdate($sql, array(
            'u'.date('Ymd His'),
            1
        ));
        
        // raw query is better, if where is >, <, in, ...
//        $affectedRows = $connection->update('testtable', 
//            ['col_varchar'=>'u'.date('Ymd His')],
//            ['id'=>2]
//        );
                        
        return new JsonResponse(['affectedRows'=>$affectedRows]);
    }
    
    /**
     * @Route("/test/mysql/delete")
     */
    public function testMysqlDelete(Connection $connection)
    {
//        $affectedRows = $connection->delete('testtable', 
//            array('id'=>3)
//        );
        
        $sql = "DELETE FROM testtable WHERE id=? ";
        
        $affectedRows = $connection->executeUpdate($sql, array(            
            5
        ));
        
        return new JsonResponse(['affectedRows'=>$affectedRows]);
    }

}
