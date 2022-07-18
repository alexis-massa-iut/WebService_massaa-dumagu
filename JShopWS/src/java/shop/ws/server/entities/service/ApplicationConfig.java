/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package shop.ws.server.entities.service;

import java.util.Set;
import javax.ws.rs.core.Application;

/**
 *
 * @author alexi
 */
@javax.ws.rs.ApplicationPath("webresources")
public class ApplicationConfig extends Application {

    @Override
    public Set<Class<?>> getClasses() {
        Set<Class<?>> resources = new java.util.HashSet<>();
        addRestResourceClasses(resources);
        return resources;
    }

    /**
     * Do not modify addRestResourceClasses() method.
     * It is automatically populated with
     * all resources defined in the project.
     * If required, comment out calling this method in getClasses().
     */
    private void addRestResourceClasses(Set<Class<?>> resources) {
        resources.add(shop.ws.server.entities.service.CategoryFacadeREST.class);
        resources.add(shop.ws.server.entities.service.CommandFacadeREST.class);
        resources.add(shop.ws.server.entities.service.CommandLineFacadeREST.class);
        resources.add(shop.ws.server.entities.service.ProductFacadeREST.class);
        resources.add(shop.ws.server.entities.service.UserFacadeREST.class);
    }
    
}
